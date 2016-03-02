<?php

class m160302_140107_update_teacher_id_plain_task_answer_teacher extends CDbMigration
{
	public function safeUp()
	{
		//$this->dropForeignKey('FK_plain_task_answer_teacher', 'plain_task_answer_teacher');
        $sql = 'update plain_task_answer_teacher set id_teacher = (select user_id from teacher where teacher_id=id_teacher);';
        $this->execute($sql);
		//$this->addForeignKey('FK_plain_task_answer_teacher_user', 'plain_task_answer_teacher', 'id_teacher', 'user', 'id');
	}

	public function safeDown()
	{
		echo " m160302_140107_update_teacher_id_plain_task_answer_teacher does not support migration down.\n";
		return false;
	}
}