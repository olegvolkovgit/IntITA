<?php

class m160331_075641_update_table_chat_tenant extends CDbMigration
{
	public function safeUp()
	{
		$this->renameTable('chat_tenant', 'user_tenant');

		$this->addColumn('user_tenant', 'start_date', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('user_tenant', 'end_date', 'DATETIME NULL DEFAULT NULL');
	}

	public function down()
	{
		echo "m160331_075641_update_table_chat_tenant does not support migration down.\n";
		return false;
	}
}