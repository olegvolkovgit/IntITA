<?php

class m170804_104525_create_table_crm_task extends CDbMigration
{
    public function safeUp() {
        $this->createTable('crm_tasks', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'name' => 'VARCHAR(128) NOT NULL',
            'body' => 'TEXT NOT NULL',
            'startTask' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'endTask' => 'DATETIME DEFAULT NULL',
            'deadline' => 'DATETIME DEFAULT NULL',
            'id_state' => 'tinyint(3) default 1',
            'created_by' => 'INT(10) NOT NULL',
            'created_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'cancelled_by' => 'INT(10) DEFAULT  NULL',
            'cancelled_date' => 'DATETIME DEFAULT NULL',
            'change_date' => 'DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('FK_crm_tasks_status','crm_tasks','id_state','crm_task_status','id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_crm_tasks_created_by','crm_tasks','created_by','user','id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_crm_tasks_cancelled_by','crm_tasks','cancelled_by','user','id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_crm_tasks_cancelled_by','crm_tasks');
        $this->dropForeignKey('FK_crm_tasks_created_by','crm_tasks');
        $this->dropForeignKey('FK_crm_tasks_status','crm_tasks');

        $this->dropTable('crm_tasks');
    }
}