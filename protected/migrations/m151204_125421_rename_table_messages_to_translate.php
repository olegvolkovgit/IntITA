<?php

class m151204_125421_rename_table_messages_to_translate extends CDbMigration
{
	public function up()
	{
        $this->renameTable('messages', 'translate');
	}

	public function down()
	{
		echo "m151204_125421_rename_table_messages_to_translate does not support migration down.\n";
		return false;
	}
}