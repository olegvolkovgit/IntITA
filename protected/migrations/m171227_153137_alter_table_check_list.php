<?php

class m171227_153137_alter_table_check_list extends CDbMigration
{
	public function safeUp()
	{
        $this->alterColumn('crm_check_list_element', 'name', 'VARCHAR(512)');
	}

	public function safeDown()
	{
	}
}