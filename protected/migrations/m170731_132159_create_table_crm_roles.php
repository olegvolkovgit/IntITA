<?php

class m170731_132159_create_table_crm_roles extends CDbMigration
{
    public function safeUp() {
        $this->createTable('crm_roles', [
            'id' => 'tinyint(3) PRIMARY KEY AUTO_INCREMENT',
            'name' => 'VARCHAR(50) NOT NULL',
            'description' => 'VARCHAR(50) NOT NULL'
        ]);

        $this->insertMultiple('crm_roles', [
            [
                'name' => 'executant',
                'description' => 'Відповідальний',
            ],
            [
                'name' => 'producer',
                'description' => 'Постановник',
            ],
            [
                'name' => 'collaborator',
                'description' => 'Співвиконавець',
            ],
            [
                'name' => 'observer',
                'description' => 'Спостерігач',
            ],
        ]);
    }

    public function safeDown() {
        $this->dropTable('crm_roles');
    }
}