<?php

class m150903_140353_add_hidden_column_config_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('config', 'hidden', 'TINYINT(1) NOT NULL DEFAULT 0');
	}

	public function down()
	{
        $this->dropColumn('config', 'hidden');
	}
}