<?php

class Student extends Role
{
    private $dbModel;
    private $errorMessage = "";
    private $modules;
    private $courses;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_student';
    }

    /**
     * @return string sql for check role student.
     */
    public function checkRoleSql()
    {
        return 'select "student" from user_student st where st.id_user = :id and end_date IS NULL';
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return string the role title (ua)
     */
    public function title()
    {
        return 'Студент';
    }

    public function attributes(StudentReg $user)
    {
        $mask = PayModules::setFlags(array('read'));

        if (!$this->courses) {
            $this->loadCourses($user, $mask);
        }
        $courses = $this->courses;

        if (!$this->modules) {
            $this->loadModules($user, $mask);
        }
        $modules = $this->modules;

        return array(
            array(
                'key' => 'module',
                'title' => 'Модулі',
                'type' => 'module-list',
                'value' => $modules,
            ),
            array(
                'key' => 'course',
                'title' => 'Курси',
                'type' => 'course-list',
                'value' => $courses
            )
        );
    }

    private function loadCourses(StudentReg $user, $mask)
    {
        $groupCourses=[];
        foreach ($user->offlineGroups as $group) {
            $groupCourses=array_merge($groupCourses,$group->availableCoursesList());
        }

        $payCourses= Yii::app()->db->createCommand()
            ->select('c.cancelled, id_course id, language lang, c.title_ua title')
            ->from('pay_courses pm')
            ->join('course c', 'c.course_ID=pm.id_course')
            ->where('id_user=:id and rights & :mask', array(':id' => $user->id, ':mask' => $mask))
            ->queryAll();
        $this->courses=array_merge($groupCourses,$payCourses);
    }

    private function loadModules(StudentReg $user, $mask)
    {
        $groupModules=[];
        foreach ($user->offlineGroups as $group) {
            $groupModules=array_merge($groupModules,$group->availableModulesList());
        }

        $payModules = Yii::app()->db->createCommand()
            ->select('m.cancelled, module_ID id, language lang, m.title_ua title, IF(tcs.end_date is null, u.id, 0) as teacherId,
            CONCAT(u.secondName, " ", u.firstName, " ", u.middleName) as teacherName, tcs.end_date, tcs.start_date')
            ->from('pay_modules pm')
            ->join('module m', 'm.module_ID=pm.id_module')
            ->leftJoin('teacher_consultant_student tcs', 'tcs.id_module=m.module_ID')
            ->leftJoin('user u', 'u.id=tcs.id_teacher')
            ->where('pm.id_user=:id and rights & :mask',
                array(':id' => $user->id, ':mask' => $mask))
            ->order('m.module_ID, tcs.end_date DESC')
            ->group('m.module_ID')
            ->queryAll();

        $this->modules=array_merge($groupModules,$payModules);
        return $this->modules;
    }

    public function getTeacherForModuleDefined($student, $module)
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'u';
        $criteria->join = 'LEFT JOIN teacher_consultant_student tcs ON tcs.id_teacher=u.id';
        $criteria->addCondition('tcs.id_module=' . $module . ' and tcs.id_student=' . $student . ' and tcs.end_date IS NULL');

        return StudentReg::model()->find($criteria);
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        return false;
    }

    public function checkBeforeDeleteRole(StudentReg $user)
    {
        return true;
    }

    //not supported
    public function addRoleFormList($query)
    {
        return array();
    }

    public function getTeachersForModules(StudentReg $student)
    {
        $records = Yii::app()->db->createCommand()
            ->select('module_ID id, CONCAT(IFNULL(u.secondName, ""), " ", IFNULL(u.firstName, ""), " ", IFNULL(u.middleName, ""),
             ", ", IFNULL(u.email, "")) as teacherName')
            ->from('module m')
            ->leftJoin('teacher_consultant_student tcs', 'tcs.id_module=m.module_ID')
            ->leftJoin('user u', 'u.id=tcs.id_teacher')
            ->leftJoin('user_teacher_consultant utc', 'utc.id_user=u.id')
            ->where('tcs.id_student = :id and tcs.end_date IS NULL and u.id IS NOT NULL and utc.end_date IS NULL',
                array(':id' => $student->id))
            ->queryAll();

        return array_column($records, 'teacherName', 'id');
    }

    //not supported for this role
    public function notifyAssignRole(StudentReg $user){
        return false;
    }

    //not supported for this role
    public function notifyCancelRole(StudentReg $user){
        return false;
    }

    function getMembers($criteria = null)
    {
        return UserStudent::model()->findAll($criteria);
    }
}
