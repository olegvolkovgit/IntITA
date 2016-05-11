<?php

class m160510_120849_change_reg_time_type_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->alterColumn('user', 'reg_time', 'VARCHAR(25)');
		$sql = 'update user set reg_time = FROM_UNIXTIME(reg_time)';
		Yii::app()->db->createCommand($sql)->execute();
		$this->alterColumn('user', 'reg_time', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
	}

	public function safeDown()
	{
		$this->alterColumn('user', 'reg_time', 'VARCHAR(25)');
		$sql = 'update user set reg_time = UNIX_TIMESTAMP(reg_time)';
		Yii::app()->db->createCommand($sql)->execute();
		$this->alterColumn('user', 'reg_time', 'INT(10)');
	}
}