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
    public function checkRoleSql($organization=null)
    {
        $condition=$organization?' and st.id_organization='.$organization:'';
        return 'select "student" from user_student st where st.id_user = :id and st.end_date IS NULL'.$condition;
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

    public function attributes(StudentReg $user, $organization=null)
    {
        if (!$this->courses) {
            $this->loadCourses($user, $organization);
        }
        $courses = $this->courses;

        if (!$this->modules) {
            $this->loadModules($user, $organization);
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

    private function loadCourses(StudentReg $user, $organization=null)
    {
        $groupCourses=[];
        foreach ($user->offlineGroups as $group) {
            $groupCourses=array_merge($groupCourses,$group->availableCoursesList($organization, $user->id));
        }

        $now = new CDbExpression("NOW()");
        $condition='sa.userId=' . $user->id.' and sa.endDate>='.$now;
        if($organization) $condition=$condition.' and c.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $accessCourses= Yii::app()->db->createCommand()
            ->select('c.cancelled, c.course_ID id, c.language lang, c.title_ua, c.title_ru, c.title_en, 
            l.title_ua level_ua, l.title_ru level_ru, l.title_en level_en, org.name, ruc.rating')
            ->from('user_service_access sa')
            ->join('acc_course_service cs', 'cs.service_id=sa.serviceId')
            ->join('course c', 'c.course_ID=cs.course_id')
            ->join('level l', 'l.id=c.level')
            ->join('organization org', 'org.id=c.id_organization')
            ->leftJoin('rating_user_course ruc', 'ruc.id_course=c.course_ID and ruc.id_user=sa.userId')
            ->where($condition)
            ->queryAll();

        $allCourses=array_merge($groupCourses,$accessCourses);
        $result = [];
        foreach($allCourses as $course){
            if(isset($result[$course['id']])) continue;
            $result[$course['id']] = $course;
        }
        $this->courses=$result;
    }

    private function loadModules(StudentReg $user, $organization=null)
    {
        $groupModules=[];
        foreach ($user->offlineGroups as $group) {
            $groupModules=array_merge($groupModules,$group->availableModulesList($organization, $user->id));
        }

        $now = new CDbExpression("NOW()");
        $condition='sa.userId=' . $user->id.' and sa.endDate>='.$now;
        if($organization) $condition=$condition.' and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $accessModules= Yii::app()->db->createCommand()
            ->select('m.cancelled, m.module_ID id, m.language lang, m.title_ua, m.title_ru, m.title_en, 
            l.title_ua level_ua, l.title_ru level_ru, l.title_en level_en, org.name, rum.rating')
            ->from('user_service_access sa')
            ->join('acc_module_service ms', 'ms.service_id=sa.serviceId')
            ->join('module m', 'm.module_ID=ms.module_id')
            ->join('level l', 'l.id=m.level')
            ->join('organization org', 'org.id=m.id_organization')
            ->leftJoin('rating_user_module rum', 'rum.id_module=m.module_ID and rum.id_user=sa.userId')
            ->where($condition)
            ->queryAll();

        $allModules=array_merge($groupModules,$accessModules);
        $result = [];
        foreach($allModules as $module){
            if(isset($result[$module['id']])) continue;
            $result[$module['id']] = $module;
        }

        $this->modules=$result;
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

    public function checkBeforeDeleteRole(StudentReg $user, $organization=null)
    {
        return true;
    }

    public function checkBeforeSetRole(StudentReg $user, $organization=null){
        return true;
    }

    //not supported
    public function addRoleFormList($query, $organization)
    {
        return array();
    }

    public function getTeachersForModules(StudentReg $student)
    {
        $records = Yii::app()->db->createCommand()
            ->select('module_ID id, CONCAT(IFNULL(u.secondName, ""), " ", IFNULL(u.firstName, ""), " ", IFNULL(u.middleName, ""),
             " ", IFNULL(tc.corporate_mail, u.email)) as teacherName, u.id teacherId')
            ->from('module m')
            ->leftJoin('teacher_consultant_student tcs', 'tcs.id_module=m.module_ID')
            ->leftJoin('user u', 'u.id=tcs.id_teacher')
            ->leftJoin('teacher tc', 'u.id=tc.user_id')
            ->leftJoin('user_teacher_consultant utc', 'utc.id_user=u.id')
            ->where('tcs.id_student = :id and tcs.end_date IS NULL and u.id IS NOT NULL and utc.end_date IS NULL',
                array(':id' => $student->id))
            ->queryAll();

        $tempArray=$records;
        $records=array_column($records, 'teacherName', 'id');

        $i=0;
        foreach ($records as $key=>$record){
            $records[$key]=array('name'=>$record,'id'=>$tempArray[$i]['teacherId']);
            $i++;
        }

        return $records;
    }

    //not supported for this role
    public function notifyAssignRole(StudentReg $user, $organization = null){
        return false;
    }

    //not supported for this role
    public function notifyCancelRole(StudentReg $user, $organization = null){
        return false;
    }

    function getMembers($criteria = null)
    {
        return UserStudent::model()->findAll($criteria);
    }

    public function setRole(StudentReg $user, $organization)
    {
        if(Yii::app()->db->createCommand()->
        insert($this->tableName(), array(
            'id_user' => $user->id,
            'assigned_by'=>Yii::app()->user->getId(),
            'id_organization'=>$organization,
        ))){
            $this->notifyAssignRole($user, $organization);
            $this->updateRolesRoom();
            return true;
        }
        return false;
    }

}
