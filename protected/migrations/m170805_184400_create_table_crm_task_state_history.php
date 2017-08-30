<?php

class m170805_184400_create_table_crm_task_state_history extends CDbMigration
{
    public function safeUp() {
        $this->createTable('crm_task_state_history', [
            'id' => 'INT(10) PRIMARY KEY AUTO_INCREMENT',
            'id_task' => 'INT NOT NULL',
            'id_state' => 'tinyint(3)',
            'id_user' => 'INT(11) NOT NULL',
            'change_date' => 'DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('FK_crm_task_state_history_task','crm_task_state_history','id_task','crm_tasks','id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_crm_task_state_history_status','crm_task_state_history','id_state','crm_task_status','id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_crm_task_state_history_user','crm_task_state_history','id_user','user','id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_crm_task_state_history_user','crm_task_state_history');
        $this->dropForeignKey('FK_crm_task_state_history_status','crm_task_state_history');
        $this->dropForeignKey('FK_crm_task_state_history_task','crm_task_state_history');

        $this->dropTable('crm_task_state_history');
    }
}