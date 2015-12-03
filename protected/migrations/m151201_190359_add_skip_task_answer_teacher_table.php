<?php

class m151201_190359_add_skip_task_answer_teacher_table extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('skip_task_answer_teacher', array(
            'id_skip_task_answer' => 'INT(10) NOT NULL',
            'id_teacher' => 'INT(10) NOT NULL',
            'PRIMARY KEY (`id_skip_task_answer`)',
            'CONSTRAINT `FK_skip_task_answer_teacher_skip_task_answers` FOREIGN KEY (`id_skip_task_answer`) REFERENCES `skip_task_answers` (`id`)',
            'CONSTRAINT `FK_skip_task_answer_teacher_teacher` FOREIGN KEY (`id_teacher`) REFERENCES `teacher` (`teacher_id`)'
        ));
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_skip_task_answer_teacher_skip_task_answers', 'skip_task_answer_teacher');
        $this->dropForeignKey('FK_skip_task_answer_teacher_teacher', 'skip_task_answer_teacher');
        $this->dropTable('skip_task_answer_teacher');
	}
}