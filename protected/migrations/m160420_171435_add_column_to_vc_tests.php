<?php

class m160420_171435_add_column_to_vc_tests extends CDbMigration
{
	public function up()
	{
        $this->addColumn('vc_tests', 'id_test', 'INT DEFAULT NULL');
	}

	public function down()
	{
        $this->dropColumn('vc_tests', 'id_test');
		echo "m160420_171435_add_column_to_vc_tests does not support migration down.\n";
		return false;
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