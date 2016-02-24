<?php

class m160224_175101_update_column_plain_task_mark_comment extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('plain_task_marks', 'comment', 'MEDIUMTEXT NULL DEFAULT NULL');
	}

	public function down()
	{
		echo "m160224_175101_update_column_plain_task_mark_comment does not support migration down.\n";
		return false;
	}
}