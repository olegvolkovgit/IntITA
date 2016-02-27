<?php

class Student extends Role
{
	private $dbModel;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_student';
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
}
