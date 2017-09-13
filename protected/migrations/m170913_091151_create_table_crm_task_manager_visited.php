<?php

class m170913_091151_create_table_crm_task_manager_visited extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('crm_task_manager_visited', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'id_user' => 'INT(10) NOT NULL',
            'date_of_visit' => 'DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('FK_crm_task_manager_visited_user','crm_task_manager_visited','id_user','user','id', 'RESTRICT', 'RESTRICT');
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_crm_task_manager_visited_user','crm_task_manager_visited');

        $this->dropTable('crm_task_manager_visited');
	}
}