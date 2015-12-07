<?php

class m151130_141203_rename_column_skip_task_marks extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->dropForeignKey('FK_skip_task_marks_skip_task_answers', 'skip_task_marks');

        $this->renameColumn ('skip_task_marks', 'id_task_answer', 'id_task');
	}

	public function safeDown()
	{
        $this->addForeignKey('FK_skip_task_marks_skip_task_answers', 'skip_task_marks','id_task','skip_task','id');
        $this->renameColumn ('skip_task_marks', 'id_task', 'id_task_answer');
	}
}