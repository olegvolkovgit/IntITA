<?php

class m161030_194351_move_payment_scemas_to_single_table extends CDbMigration {
    public function safeUp() {
        $this->addColumn('acc_payment_schema', 'type', 'TINYINT NOT NULL DEFAULT 0 ' .
            'COMMENT ' .
            '"0 - default payment schema (PaymentScheme.php), ' .
            '1 - user-specified payment schema (UserSpecialOffer.php) ' .
            '2 - course-specified payment schema (CourseSpecialOffer.php) ' .
            '3 - module-specified payment schema (ModuleSpecialOffer.php)"');
        $this->addColumn('acc_payment_schema', 'userId', 'INT');
        $this->addColumn('acc_payment_schema', 'courseId', 'INT');
        $this->addColumn('acc_payment_schema', 'moduleId', 'INT');
        $this->addColumn('acc_payment_schema', 'startDate', 'DATETIME NULL DEFAULT NULL');
        $this->addColumn('acc_payment_schema', 'endDate', "DATETIME NULL DEFAULT '9999-12-31 23:59:59'");
        $this->renameColumn('acc_payment_schema', 'pay_count', "payCount");

        $connection = $this->getDbConnection();

        $userSpecialOfferTable = 'SELECT * FROM acc_user_special_offer_payment';
        $userSpecialOffers = $connection->createCommand($userSpecialOfferTable)->queryAll();
        if (!empty($userSpecialOffers)) {
            $userSpecialOffers = array_map(function($item) {
                $item['type'] = '1';
                unset ($item['id']);
                return $item;
            }, $userSpecialOffers);
            $this->insertMultiple('acc_payment_schema', $userSpecialOffers);
        }

        $courseSpecialOfferTable = 'SELECT * FROM acc_course_special_offer';
        $courseSpecialOffers = $connection->createCommand($courseSpecialOfferTable)->queryAll();
        if (!empty($courseSpecialOffers)) {
            $courseSpecialOffers = array_map(function($item) {
                $item['type'] = '2';
                unset ($item['id']);
                return $item;
            }, $courseSpecialOffers);
            $this->insertMultiple('acc_payment_schema', $courseSpecialOffers);
        }

        $moduleSpecialOfferTable = 'SELECT * FROM acc_module_special_offer';
        $moduleSpecialOffers = $connection->createCommand($moduleSpecialOfferTable)->queryAll();
        if (!empty($moduleSpecialOffers)) {
            $moduleSpecialOffers = array_map(function($item) {
                $item['type'] = '3';
                unset ($item['id']);
                return $item;
            }, $moduleSpecialOffers);
            $this->insertMultiple('acc_payment_schema', $moduleSpecialOffers);
        }

        $this->dropTable('acc_user_special_offer_payment');
        $this->dropTable('acc_course_special_offer');
        $this->dropTable('acc_module_special_offer');
    }

    public function safeDown() {

        $this->createTable('acc_module_special_offer', [
            'id' => 'INT NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'moduleId' => 'INT NOT NULL',
            'discount' => "DECIMAL(10,2) NOT NULL DEFAULT 0.00 COMMENT 'відсоток знижки'",
            'payCount' => "int(11) NOT NULL DEFAULT '1' COMMENT 'кількість проплат'",
            'loan' => "decimal(10,0) NOT NULL DEFAULT '0' COMMENT 'відсоток'",
            'name' => "varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Спеціальна пропозиція' COMMENT 'опис'",
            'monthpay' => "tinyint(1) NOT NULL DEFAULT '0'",
            'startDate' => "DATETIME NULL DEFAULT NULL",
            'endDate' => "DATETIME NULL DEFAULT '9999-12-31 23:59:59'"
        ]);

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

        $connection = $this->getDbConnection();

        $deleteFromPaymentSchemaIds = [];

        $userSpecialOfferTable = 'SELECT * FROM acc_payment_schema where type = 1';
        $userSpecialOffers = $connection->createCommand($userSpecialOfferTable)->queryAll();
        if (!empty($userSpecialOffers)) {
            $userSpecialOffers = array_map(function($item) use (&$deleteFromPaymentSchemaIds) {
                $deleteFromPaymentSchemaIds[] = $item['id'];
                unset ($item['type']);
                unset ($item['id']);
                return $item;
            }, $userSpecialOffers);
            $this->insertMultiple('acc_user_special_offer_payment', $userSpecialOffers);
        }

        $courseSpecialOfferTable = 'SELECT * FROM acc_payment_schema where type = 2';
        $courseSpecialOffers = $connection->createCommand($courseSpecialOfferTable)->queryAll();
        if (!empty($courseSpecialOffers)) {
            $courseSpecialOffers = array_map(function($item) use (&$deleteFromPaymentSchemaIds) {
                $deleteFromPaymentSchemaIds[] = $item['id'];
                unset ($item['type']);
                unset ($item['id']);
                return $item;
            }, $courseSpecialOffers);
            $this->insertMultiple('acc_course_special_offer', $courseSpecialOffers);
        }

        $moduleSpecialOfferTable = 'SELECT * FROM acc_payment_schema where type = 3';
        $moduleSpecialOffers = $connection->createCommand($moduleSpecialOfferTable)->queryAll();
        if (!empty($moduleSpecialOffers)) {
            $moduleSpecialOffers = array_map(function($item) use (&$deleteFromPaymentSchemaIds) {
                $deleteFromPaymentSchemaIds[] = $item['id'];
                unset ($item['type']);
                unset ($item['id']);
                return $item;
            }, $moduleSpecialOffers);
            $this->insertMultiple('acc_module_special_offer', $moduleSpecialOffers);
        }

        $this->dropColumn('acc_payment_schema', 'type');
        $this->dropColumn('acc_payment_schema', 'userId');
        $this->dropColumn('acc_payment_schema', 'courseId');
        $this->dropColumn('acc_payment_schema', 'moduleId');
        $this->dropColumn('acc_payment_schema', 'startDate');
        $this->dropColumn('acc_payment_schema', 'endDate');
        $this->renameColumn('acc_payment_schema', "payCount", 'pay_count');

        $this->delete('acc_payment_schema', 'id IN ('.implode(',', $deleteFromPaymentSchemaIds).')');

        return true;
    }
}