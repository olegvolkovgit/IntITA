<?php

class m160407_105055_delete_unneccessary_table_plain_task_answer_teacher extends CDbMigration
{
	//Reason - changed business logic for plain tasks
    //Data is only for tester's users and not equal new logic
	public function safeUp()
	{
        $this->dropIndex('FK_plain_task_answer_teacher_teacher', 'plain_task_answer_teacher');
        $this->dropIndex('FK_plain_task_answer_teacher_plain_task_answer', 'plain_task_answer_teacher');
        $this->dropForeignKey('FK_plain_task_answer_teacher_plain_task_answer', 'plain_task_answer_teacher');
        $this->dropTable('plain_task_answer_teacher');
        $this->dropColumn('plain_task_answer', 'consultant');
	}

	public function down()
	{
		echo "m160407_105055_delete_unneccessary_table_plain_task_answer_teacher does not support migration down.\n";
		return false;
	}
}