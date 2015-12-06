<?php

class m151206_172658_rename_table_message_comment extends CDbMigration
{
	public function up()
	{
        $this->renameTable('message_comment', 'translate_comment');
	}

	public function down()
	{
		echo "m151206_172658_rename_table_message_comment does not support migration down.\n";
		return false;
	}
}