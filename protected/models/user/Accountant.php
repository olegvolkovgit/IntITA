<?php


class Accountant extends Role
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_accountant';
	}

    /**
     * @return string the role title (ua)
     */
	public function title(){
		return 'Бухгалтер';
	}


    public function attributes(StudentReg $user)
    {
        return array();
    }
}
