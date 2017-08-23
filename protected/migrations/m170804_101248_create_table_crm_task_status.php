<?php

class m170804_101248_create_table_crm_task_status extends CDbMigration
{
    public function safeUp() {
        $this->createTable('crm_task_status', [
            'id' => 'tinyint(3) PRIMARY KEY AUTO_INCREMENT',
            'name' => 'VARCHAR(50) NOT NULL',
            'description' => 'VARCHAR(50) NOT NULL',
        ]);

        $this->insertMultiple('crm_task_status', [
            [
                'name' => 'expectToExecute',
                'description' => 'Очікує на виконання',
            ],
            [
                'name' => 'executed',
                'description' => 'Виконується',
            ],
            [
                'name' => 'paused',
                'description' => 'Призупинено',
            ],
            [
                'name' => 'completed',
                'description' => 'Завершено',
            ],
        ]);
    }

    public function safeDown() {
        $this->dropTable('crm_task_status');
    }
}