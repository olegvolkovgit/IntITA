<?php

class m160609_200722_add_module_uid_vc_module extends CDbMigration
{
	public function up()
	{
        $this->addColumn('vc_module', 'uid_module', 'INT (10) NOT NULL');
	}

	public function down()
	{
        $this->dropColumn('vc_module', 'uid_module');
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}