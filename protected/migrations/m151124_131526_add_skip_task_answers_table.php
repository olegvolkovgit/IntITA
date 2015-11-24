<?php

class m151124_131526_add_skip_task_answers_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('skip_task_answers', array(
            'id' => 'pk',
            'id_task' => 'INT(10) NOT NULL',
            'answer' => 'VARCHAR(255) NOT NULL',
            'answer_order' => 'INT(11) NOT NULL',
            'INDEX `FK_skip_task_answers_skip_task` (`id_task`)',
            'CONSTRAINT `FK_skip_task_answers_skip_task` FOREIGN KEY (`id_task`) REFERENCES `skip_task` (`id`)',
        ), "COLLATE='utf8_general_ci'
            ENGINE=InnoDB");
    }

    public function down()
    {
        $this->dropTable('skip_task_answer');
    }
}