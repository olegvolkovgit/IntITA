<?php

class Student extends Role
{
	private $dbModel;
	private $errorMessage = "";

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
	public function checkRoleSql(){
		return 'select "student" from user_student st where st.id_user = :id and end_date IS NULL';
	}

    public function getErrorMessage(){
        return $this->errorMessage;
    }

	/**
	 * @return string the role title (ua)
	 */
	public function title(){
		return 'Студент';
	}

	public function attributes(StudentReg $user)
	{
		$mask = PayModules::setFlags(array('read'));

        $courses = Yii::app()->db->createCommand()
            ->select('id_course id, language lang, c.title_ua title')
            ->from('pay_courses pm')
            ->join('course c', 'c.course_ID=pm.id_course')
            ->where('id_user=:id and rights & :mask', array(':id' => $user->id, ':mask' => $mask))
            ->queryAll();

		$modules = Yii::app()->db->createCommand()
			->select('module_ID id, language lang, m.title_ua title, u.id teacherId, CONCAT(u.secondName, " ", u.firstName, " ", u.middleName) teacherName')
			->from('pay_modules pm')
			->join('module m', 'm.module_ID=pm.id_module')
            ->leftJoin('teacher_consultant_student tcs', 'tcs.id_module=m.module_ID')
            ->leftJoin('user u', 'u.id=tcs.id_teacher')
			->where('id_user=:id and rights & :mask and (tcs.id_student IS NULL or (tcs.id_student=:id and tcs.end_date IS NULL))',
                array(':id' => $user->id, ':mask' => $mask))
			->queryAll();

		return array(
            array(
                'key' => 'module',
                'title' => 'Модулі',
                'type' => 'module-list',
                'value' => $modules
            ),
            array(
                'key' => 'course',
                'title' => 'Курси',
                'type' => 'course-list',
                'value' => $courses
            )
        );
	}

    public function getTeacherForModuleDefined($student, $module)
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'u';
        $criteria->join = 'LEFT JOIN teacher_consultant_student tcs ON tcs.id_teacher=u.id';
        $criteria->addCondition('tcs.id_module='.$module.' and tcs.id_student='.$student.' and tcs.end_date IS NULL');

        return StudentReg::model()->find($criteria);
    }

	public  function cancelAttribute(StudentReg $user, $attribute, $value)
	{
		return false;
	}

	public function checkBeforeDeleteRole(StudentReg $user){
		return true;
	}

	//not supported
	public function addRoleFormList($query){
		return array();
	}
}
