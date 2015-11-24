<?php

class m151124_131514_add_skip_task_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('skip_task', array(
            'id' => 'pk',
            'author' => 'INT(10) NOT NULL',
            'condition' => 'INT(10) NOT NULL',
            'INDEX `FK_skip_task_teacher` (`author`)',
            'INDEX `FK_skip_task_lecture_element` (`condition`)',
            'CONSTRAINT `FK_skip_task_lecture_element` FOREIGN KEY (`condition`) REFERENCES `lecture_element` (`id_block`)',
            'CONSTRAINT `FK_skip_task_teacher` FOREIGN KEY (`author`) REFERENCES `teacher` (`teacher_id`)',
        ), "COLLATE='utf8_general_ci'
            ENGINE=InnoDB");
    }

    public function down()
    {
        $this->dropTable('skip_task');
    }
}