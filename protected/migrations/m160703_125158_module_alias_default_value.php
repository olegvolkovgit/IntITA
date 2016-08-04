<?php

class m160703_125158_module_alias_default_value extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('module', 'alias', 'VARCHAR(30) DEFAULT NULL');
        $this->alterColumn('vc_module_properties', 'alias', 'VARCHAR(30) DEFAULT NULL');
	}

	public function down()
	{
        $this->alterColumn('module', 'alias', 'VARCHAR(30) NOT NULL');
        $this->alterColumn('vc_module_properties', 'alias', 'VARCHAR(30) NOT NULL');
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