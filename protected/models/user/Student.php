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
		return array();
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
