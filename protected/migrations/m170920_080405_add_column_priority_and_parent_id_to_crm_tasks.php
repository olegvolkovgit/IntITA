<?php

class m170920_080405_add_column_priority_and_parent_id_to_crm_tasks extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('crm_task_priority', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'title' => 'VARCHAR(50) NOT NULL',
            'description' => 'VARCHAR(50) NOT NULL',
        ]);

        $this->insertMultiple('crm_task_priority', [
            [
                'title' => 'low',
                'description' => 'Низький',
            ],
            [
                'title' => 'medium',
                'description' => 'Середній',
            ],
            [
                'title' => 'high',
                'description' => 'Високий',
            ],
            [
                'title' => 'urgent',
                'description' => 'Терміновий',
            ],
        ]);

        $this->addColumn('crm_tasks', 'priority', 'INT NOT NULL DEFAULT 2');
        $this->addColumn('crm_tasks', 'id_parent', 'INT DEFAULT NULL');

        $this->addForeignKey('FK_crm_tasks_priority','crm_tasks','priority','crm_task_priority','id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_crm_tasks_parent_task','crm_tasks','id_parent','crm_tasks','id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_crm_tasks_parent_task','crm_tasks');
        $this->dropForeignKey('FK_crm_tasks_priority','crm_tasks');

        $this->dropColumn('crm_tasks', 'id_parent');
        $this->dropColumn('crm_tasks', 'priority');

        $this->dropTable('crm_task_priority');
    }
}