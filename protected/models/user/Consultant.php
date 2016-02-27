<?php

class Consultant extends Role
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_consultant';
	}

	/**
	 * @return string the role title (ua)
	 */
	public function title(){
		return 'Консультант';
	}

	public function attributes(StudentReg $user)
	{
		return array();
	}
}
