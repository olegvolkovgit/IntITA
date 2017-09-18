<?php

class m170818_100711_create_table_crm_task_comments extends CDbMigration
{
    public function safeUp() {
        $this->createTable('crm_task_comments', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'id_task' => 'INT NOT NULL',
            'id_parent' => 'INT DEFAULT NULL',
            'id_user' => 'INT(10) NOT NULL',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'change_date' => 'DATETIME DEFAULT NULL',
            'message' => 'TEXT NOT NULL',
        ]);

        $this->addForeignKey('FK_crm_task_comments_task','crm_task_comments','id_task','crm_tasks','id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_crm_task_comments_parent_comment','crm_task_comments','id_parent','crm_task_comments','id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_crm_task_comments_user','crm_task_comments','id_user','user','id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_crm_task_comments_user','crm_task_comments');
        $this->dropForeignKey('FK_crm_task_comments_parent_comment','crm_task_comments');
        $this->dropForeignKey('FK_crm_task_comments_task','crm_task_comments');

        $this->dropTable('crm_task_comments');
    }
}