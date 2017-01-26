<?php

class m170118_223554_update_table_acc_payment_schema extends CDbMigration
{
	public function safeUp()
	{
		$this->dropTable('acc_payment_schema');

		$this->createTable('acc_payment_schema', array(
			'id' => 'pk',
			'id_template' => 'INT(10) NOT NULL',
			'userId' => 'INT(10) NULL DEFAULT NULL',
			'serviceId' => 'INT(10) NULL DEFAULT NULL',
			'serviceType' => 'TINYINT(1) NULL DEFAULT NULL',
			'startDate'=> 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP', 
			'endDate'=> "DATETIME NULL DEFAULT '9999-12-31 23:59:59'",
		));

		$this->insertMultiple('acc_payment_schema', array(
			array(
				'id' => '1',
				'id_template' => '1',
				'startDate' => '2017-01-01 00:00:01',
				'endDate' => '9999-12-31 23:59:59',
			),
			array(
				'id' => '2',
				'id_template' => '1',
				'startDate' => '2017-01-01 00:00:01',
				'endDate' => '9999-12-31 23:59:59',
			),
			array(
				'id' => '3',
				'id_template' => '2',
				'startDate' => '2017-01-01 00:00:01',
				'endDate' => '9999-12-31 23:59:59',
			),
			array(
				'id' => '4',
				'id_template' => '2',
				'startDate' => '2017-01-01 00:00:01',
				'endDate' => '9999-12-31 23:59:59',
			),
			
		));
	}

	public function safeDown()
	{
		$this->dropTable('acc_payment_schema');

		$this->createTable('acc_payment_schema', array(
			'id' => 'pk',
			'discount' => 'DECIMAL(10,2) NOT NULL DEFAULT "0.00" COMMENT "відсоток знижки"',
			'payCount' => 'INT(11) NOT NULL DEFAULT "1" COMMENT "кількість проплат"',
			'loan' => 'DECIMAL(10,0) NOT NULL DEFAULT "0" COMMENT "відсоток"',
			'name' => 'VARCHAR(512) NOT NULL COMMENT "опис" COLLATE `utf8_bin`',
			'monthpay' => 'TINYINT(1) NOT NULL DEFAULT "0"',
			'userId' => 'INT(10) NULL DEFAULT NULL',
			'serviceId' => 'INT(10) NULL DEFAULT NULL',
			'startDate'=> 'DATETIME NULL DEFAULT NULL',
			'endDate'=> "DATETIME NULL DEFAULT '9999-12-31 23:59:59'",
		));

		$this->insertMultiple('acc_payment_schema', array(
			array(
				'id' => '1',
				'discount' => '30',
				'payCount' => '1',
				'loan' => '0',
				'name' => 'Проплата наперед',
				'monthpay' => '0',
			),
			array(
				'id' => '2',
				'discount' => '10',
				'payCount' => '2',
				'loan' => '0',
				'name' => 'Дві проплати',
				'monthpay' => '0',
			),
			array(
				'id' => '3',
				'discount' => '8',
				'payCount' => '4',
				'loan' => '0',
				'name' => '4 проплати',
				'monthpay' => '0',
			),
			array(
				'id' => '4',
				'discount' => '0',
				'payCount' => '12',
				'loan' => '0',
				'name' => 'Оплата за рік помісячно',
				'monthpay' => '12',
			),
			array(
				'id' => '5',
				'discount' => '0',
				'payCount' => '24',
				'loan' => '24',
				'name' => 'Кредитування на 2 роки',
				'monthpay' => '24',
			),
			array(
				'id' => '6',
				'discount' => '0',
				'payCount' => '36',
				'loan' => '24',
				'name' => 'Кредитування на 3 роки',
				'monthpay' => '36',
			),
			array(
				'id' => '7',
				'discount' => '0',
				'payCount' => '48',
				'loan' => '24',
				'name' => 'Кредитування на 4 роки',
				'monthpay' => '48',
			),
			array(
				'id' => '8',
				'discount' => '0',
				'payCount' => '60',
				'loan' => '24',
				'name' => 'Кредитування на 5 років',
				'monthpay' => '60',
			),
		));
	}
}