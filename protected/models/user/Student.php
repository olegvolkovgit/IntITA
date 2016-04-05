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
			->select('id_module id, language lang, m.title_ua title')
			->from('pay_modules pm')
			->join('module m', 'm.module_ID=pm.id_module')
			->where('id_user=:id and rights & :mask', array(':id' => $user->id, ':mask' => $mask))
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
