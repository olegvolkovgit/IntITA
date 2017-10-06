<?php

class m171006_120751_create_index_plain_task_marks_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addForeignKey('FK_task_mark_answer','plain_task_marks','id_answer','plain_task_answer','id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_task_mark_answer','plain_task_marks');
    }
}