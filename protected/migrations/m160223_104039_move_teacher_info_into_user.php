<?php

class m160223_104039_move_teacher_info_into_user extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('user', 'skype', 'VARCHAR(50) NOT NULL');

		$sqlFirstName="update user set firstName = (select first_name from teacher where user_id=id) where id in (select user_id from teacher)";
		$sqlSecondName = "update user set secondName = (select last_name from teacher where user_id=id) where id in (select user_id from teacher)";
        $sqlMiddleName = "update user set middleName = (select middle_name from teacher where user_id=id) where id in (select user_id from teacher)";
        $sqlAvatar = "update user set avatar = (select foto_url from teacher where user_id=id) where id in (select user_id from teacher)";
        $sqlSkype = "update user set skype = (select skype from teacher where user_id=id) where id in (select user_id from teacher)";
        $sqlPhone = "update user set phone = (select tel from teacher where user_id=id) where id in (select user_id from teacher)";

        $this->execute($sqlFirstName);
        $this->execute($sqlSecondName);
        $this->execute($sqlMiddleName);
        $this->execute($sqlAvatar);
        $this->execute($sqlSkype);
        $this->execute($sqlPhone);

        $this->dropColumn('teacher', 'first_name');
        $this->dropColumn('teacher', 'last_name');
        $this->dropColumn('teacher', 'middle_name');
        $this->dropColumn('teacher', 'foto_url');
        $this->dropColumn('teacher', 'skype');
        $this->dropColumn('teacher', 'email');
        $this->dropColumn('teacher', 'tel');
        $this->dropColumn('teacher', 'subjects');
        $this->dropColumn('teacher', 'readMoreLink');
    }

	public function safeDown()
	{
        echo "m160223_104039_move_teacher_info_into_user does not support migration down.\n";
        return false;
	}

}