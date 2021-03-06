<?php

class m160318_100815_add_time_columns_plain_task_answer_teacher_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('plain_task_answer_teacher', 'start_date', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('plain_task_answer_teacher', 'end_date', 'DATETIME NULL');
	}

	public function safeDown()
	{
		echo "m160318_100815_add_time_columns_plain_task_answer_teacher_table does not support migration down.\n";
		return false;
	}
}