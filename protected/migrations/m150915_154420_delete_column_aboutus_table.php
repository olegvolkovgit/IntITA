<?php

class m150915_154420_delete_column_aboutus_table extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('aboutus', 'linkAddress');
	}

	public function down()
	{
		echo "m150915_154420_delete_column_aboutus_table does not support migration down.\n";
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