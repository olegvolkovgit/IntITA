<?php

class m161007_055451_create_table_acc_user_special_offer_payment extends CDbMigration {
    public function up() {
        $this->createTable('acc_user_special_offer_payment', [
            'id' => 'INT NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'userId' => 'INT NOT NULL',
            'courseId' => 'INT DEFAULT NULL',
            'moduleId' => 'INT DEFAULT NULL',
            'discount' => "DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT 'відсоток знижки'",
            'payCount' => "int(11) NOT NULL DEFAULT '1' COMMENT 'кількість проплат'",
            'loan' => "decimal(10,0) NOT NULL DEFAULT '0' COMMENT 'відсоток'",
            'name' => "varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Спеціальна пропозиція' COMMENT 'опис'",
            'monthpay' => "tinyint(1) NOT NULL DEFAULT '0'",
            'startDate' => "DATETIME NULL DEFAULT NULL",
            'endDate' => "DATETIME NULL DEFAULT '9999-12-31 23:59:59'"
        ]);

        $this->addForeignKey('FK_user_special_offer_user', 'acc_user_special_offer_payment', 'userId', 'user', 'id');
    }

    public function down() {
        $this->dropForeignKey('FK_user_special_offer_user', 'acc_user_special_offer_payment');
        $this->dropTable('acc_user_special_offer_payment');
        return true;
    }
}