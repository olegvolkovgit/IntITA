<?php

class m151011_224109_add_cancelled_column_module_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('module', 'cancelled', 'TINYINT(1) NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->dropColumn('module', 'cancelled');
	}
}