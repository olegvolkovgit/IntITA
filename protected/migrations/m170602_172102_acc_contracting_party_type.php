<?php

class m170602_172102_acc_contracting_party_type extends CDbMigration {

    public function safeUp() {

        $this->createTable('acc_contracting_party_type', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'name' => 'VARCHAR(50) NOT NULL',
            'description' => 'VARCHAR(512) DEFAULT NULL'
        ]);

        $this->insertMultiple('acc_contracting_party_type', [
            [
                'name' => 'CorporateEntity',
                'description' => 'Corporate entities (юридические лица)'
            ],
            [
                'name' => 'PrivateEntrepreneur',
                'description' => 'Type for PE (entrepreneur)'
            ],
            [
                'name' => 'PrivatePerson',
                'description' => 'Type for private persons (физическое лицо)'
            ],
        ]);
    }

    public function safeDown() {
        $this->dropTable('acc_contracting_party_type');
    }
}