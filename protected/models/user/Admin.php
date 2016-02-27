<?php

class Admin extends Role
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_admin';
	}

	/**
	 * @return string the role title (ua)
	 */
	public function title(){
		return 'Адміністратор';
	}

	public function attributes(StudentReg $user)
	{
		return array();
	}
}
