<?php

class m161202_174058_update_offline_subgroups_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('offline_subgroups', 'id_trainer', "INT(10) NULL DEFAULT NULL");
	}

	public function safeDown()
	{
		$this->dropColumn('offline_subgroups', 'id_trainer');
	}
}