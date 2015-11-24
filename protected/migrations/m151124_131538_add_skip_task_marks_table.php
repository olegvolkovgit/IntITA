<?php

class m151124_131538_add_skip_task_marks_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('skip_task_marks', array(
            'id' => 'pk',
            'user' => 'INT(10) NOT NULL',
            'id_task_answer' => 'INT(10) NOT NULL',
            'mark' => 'INT(10) NOT NULL',
            'time' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'INDEX `FK_skip_task_marks_user` (`user`)',
            'INDEX `FK_skip_task_marks_skip_task` (`id_task_answer`)',
            'CONSTRAINT `FK_skip_task_marks_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`)',
            'CONSTRAINT `FK_skip_task_marks_skip_task_answers` FOREIGN KEY (`id_task_answer`) REFERENCES `skip_task_answers` (`id`)'
        ), "COLLATE='utf8_general_ci'
            ENGINE=InnoDB");
    }

    public function down()
    {
        $this->dropTable('skip_task_marks');
    }
}