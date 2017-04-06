<?php

class m170404_120440_delete_capacity_column_from_trainer_and extends CDbMigration
{

	public function safeUp()
	{
		$this->dropColumn('user_teacher_consultant', 'capacity');
		$this->dropColumn('user_trainer', 'capacity');
	}

	public function safeDown()
	{
		echo "m170404_120440_delete_capacity_column_from_trainer_and does not support migration down.\n";
		return false;
	}
}