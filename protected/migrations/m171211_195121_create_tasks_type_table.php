<?php

class m171211_195121_create_tasks_type_table extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('crm_task_type', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'title' => 'VARCHAR(50) NOT NULL',
            'description' => 'VARCHAR(50) NOT NULL',
        ]);

        $this->insertMultiple('crm_task_type', [
            [
                'title' => 'Task',
                'description' => 'Task',
            ],
            [
                'title' => 'Bug',
                'description' => 'Bug',
            ],
            [
                'title' => 'Feature',
                'description' => 'Feature',
            ],
            [
                'title' => 'Support',
                'description' => 'Support',
            ],
            [
                'title' => 'Technical advice',
                'description' => 'Technical advice',
            ],
            [
                'title' => 'Improvement',
                'description' => 'Improvement',
            ],
            [
                'title' => 'Requirement',
                'description' => 'Requirement',
            ],
            [
                'title' => 'Test Case',
                'description' => 'Test Case',
            ],
            [
                'title' => 'Test',
                'description' => 'Test',
            ],
            [
                'title' => 'Course project',
                'description' => 'Course project',
            ],
            [
                'title' => 'Diploma project',
                'description' => 'Diploma project',
            ],
            [
                'title' => 'Interview',
                'description' => 'Interview',
            ],
            [
                'title' => 'Assessment',
                'description' => 'Assessment',
            ],
            [
                'title' => 'Essey',
                'description' => 'Essey',
            ],
            [
                'title' => 'CV',
                'description' => 'CV',
            ],
            [
                'title' => 'Motivation letter',
                'description' => 'Motivation letter',
            ],
            [
                'title' => 'Hometask',
                'description' => 'Hometask',
            ],
            [
                'title' => 'Consultation',
                'description' => 'Consultation',
            ],
            [
                'title' => 'Event',
                'description' => 'Event',
            ],
            [
                'title' => 'Rest',
                'description' => 'Rest',
            ],
        ]);

        $this->addColumn('crm_tasks', 'type', 'INT NOT NULL DEFAULT 1');

        $this->addForeignKey('FK_crm_tasks_type','crm_tasks','type','crm_task_type','id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_crm_tasks_type','crm_tasks');

        $this->dropColumn('crm_tasks', 'type');

        $this->dropTable('crm_task_type');
    }
}