<?php

class m160609_110126_add_column_id_module_revision_to_module_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('module', 'id_module_revision', 'INT DEFAULT NULL');
	}

	public function safeDown()
	{
		$this->dropColumn('module', 'id_module_revision');
	}
}