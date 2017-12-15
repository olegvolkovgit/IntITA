<?php

class m171213_160751_create_crm_check_list_element extends CDbMigration
{
    public function safeUp() {
        $this->createTable('crm_check_list_element', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'id_list' => 'INT NOT NULL',
            'name' => 'varchar(128) not null',
            'done' => 'BOOLEAN NOT NULL DEFAULT FALSE',
        ]);

        $this->addForeignKey('FK_crm_check_list_element_list','crm_check_list_element','id_list','crm_check_list','id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropForeignKey('FK_crm_check_list_element_list','crm_check_list_element');

        $this->dropTable('crm_check_list_element');
    }
}