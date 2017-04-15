<?php

class m170415_173916_create_corporate_entity_service_binging_table extends CDbMigration {

    public function up() {
        $this->createTable('acc_corporate_entity_service', [
            'id' => 'INT UNSIGNED PRIMARY KEY AUTO_INCREMENT',
            'corporateEntityId' => 'INT(11) NOT NULL',
            'serviceId' => 'INT(10) UNSIGNED NOT NULL',
            'createdAt' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'deletedAt' => 'DATETIME DEFAULT NULL',
            'CONSTRAINT `FK_acc_corporate_entity_service_service` FOREIGN KEY (`serviceId`) REFERENCES `acc_service` (`service_id`)',
            'CONSTRAINT `FK_acc_corporate_entity_service_corporate_entity` FOREIGN KEY (`corporateEntityId`) REFERENCES `acc_corporate_entity` (`id`)',
        ]);
    }

    public function down() {
        $this->dropTable('acc_corporate_entity_service');
    }
}