<?php

class m151203_121422_add_plain_task_answer_teacher_table extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('plain_task_answer_teacher', array(
            'id_plain_task_answer' => 'INT(10) NOT NULL',
            'id_teacher' => 'INT(10) NOT NULL',
            'INDEX `FK_plain_task_answer_teacher_teacher` (`id_teacher`)',
            'CONSTRAINT `FK_plain_task_answer_teacher_plain_task_answer` FOREIGN KEY (`id_plain_task_answer`) REFERENCES `plain_task_answer` (`id`)',
            'CONSTRAINT `FK_plain_task_answer_teacher_teacher` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`teacher_id`)'
        ));
	}

	public function safeDown()
	{
        $this->dropForeignKey('plain_task_answer_teacher', 'FK_plain_task_answer_teacher_plain_task_answer');
        $this->dropForeignKey('plain_task_answer_teacher', 'FK_plain_task_answer_teacher_teacher');
        $this->dropTable('plain_task_answer_teacher');
	}
}