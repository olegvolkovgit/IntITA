<?php

class m150920_212657_add_module_number_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('module', 'module_number', 'INT(10) NULL DEFAULT NULL');
	}

	public function down()
	{
        $this->dropColumn('module', 'module_number');
	}
}