<?php

class m160120_162720_rename_column_in_plain_task_marks_table extends CDbMigration
{
	public function up()
	{
		$this->renameColumn('plain_task_marks', 'id_task', 'id_answer');
	}

	public function down()
	{
        $this->renameColumn('plain_task_marks', 'id_answer', 'id_task');
	}
}