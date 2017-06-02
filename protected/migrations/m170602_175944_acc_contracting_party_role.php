<?php

class m170602_175944_acc_contracting_party_role extends CDbMigration {
    public function safeUp() {
        $this->createTable('acc_contracting_party_role', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'name' => 'VARCHAR(50) NOT NULL'
        ]);

        $this->insertMultiple('acc_contracting_party_role', [
            [
                'name' => 'student',
            ],
            [
                'name' => 'Company',
            ]
        ]);
    }

    public function safeDown() {
        $this->dropTable('acc_contracting_party_role');
    }
}