<?php

class m161008_192013_create_table_acc_course_special_offer extends CDbMigration {
    public function up() {
        $this->createTable('acc_course_special_offer', [
            'id' => 'INT NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'courseId' => 'INT NOT NULL',
            'discount' => "DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT 'відсоток знижки'",
            'payCount' => "int(11) NOT NULL DEFAULT '1' COMMENT 'кількість проплат'",
            'loan' => "decimal(10,0) NOT NULL DEFAULT '0' COMMENT 'відсоток'",
            'name' => "varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Спеціальна пропозиція' COMMENT 'опис'",
            'monthpay' => "tinyint(1) NOT NULL DEFAULT '0'",
            'startDate' => "DATETIME NULL DEFAULT NULL",
            'endDate' => "DATETIME NULL DEFAULT '9999-12-31 23:59:59'"
        ]);
    }

    public function down() {
        $this->dropTable('acc_course_special_offer');
    }
}