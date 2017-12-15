<?php

class m171213_123811_create_crm_check_list extends CDbMigration
{
    public function safeUp() {
        $this->createTable('crm_check_list', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'name' => 'varchar(64) not null',
            'id_task' => 'INT NOT NULL',
        ]);

        $this->addForeignKey('FK_crm_check_list_task','crm_check_list','id_task','crm_tasks','id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_crm_check_list_task','crm_check_list');

        $this->dropTable('crm_check_list');
    }
}