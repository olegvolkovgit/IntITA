<?php

class m150921_135209_change_module_alias_column_size extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('module', 'alias', 'VARCHAR(30) NOT NULL');
	}

	public function down()
	{
		echo "m150921_135209_change_module_alias_column_size does not support migration down.\n";
		return false;
	}
}