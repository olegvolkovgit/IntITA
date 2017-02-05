<?php

class m170130_110014_add_column_read_to_plain_task_mark_and_answer_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('plain_task_answer', 'read_answer', 'BOOLEAN NOT NULL DEFAULT FALSE');
		$this->addColumn('plain_task_marks', 'read_mark', 'BOOLEAN NOT NULL DEFAULT FALSE');
		$this->addColumn('plain_task_marks', 'marked_by', 'INT(10) DEFAULT NULL');
		$this->update('plain_task_answer', array('read_answer' => true));
		$this->update('plain_task_marks', array('read_mark' => true));
	}

	public function safeDown()
	{
		$this->dropColumn('plain_task_answer', 'read_answer');
		$this->dropColumn('plain_task_marks', 'read_mark');
		$this->dropColumn('plain_task_marks', 'marked_by');
	}
}