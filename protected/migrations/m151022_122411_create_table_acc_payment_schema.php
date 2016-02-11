<?php

class m151022_122411_create_table_acc_payment_schema extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('acc_payment_schema', array(
            'id' => 'pk',
            'discount' => 'DECIMAL(10,2) NOT NULL DEFAULT "0.00" COMMENT "відсоток знижки"',
            'pay_count' => 'INT(11) NOT NULL DEFAULT "1" COMMENT "кількість проплат"',
            'loan' => 'DECIMAL(10,0) NOT NULL DEFAULT "0" COMMENT "відсоток"',
            'name' => 'VARCHAR(512) NOT NULL COMMENT "опис" COLLATE `utf8_bin`',
            'monthpay' => 'TINYINT(1) NOT NULL DEFAULT "0"',
        ));
		$this->insertMultiple('acc_operation_type', array(
			array(
                'id' => '1',
                'discount' => '30',
                'pay_count' => '1',
                'loan' => '0',
                'name' => 'Проплата наперед',
                'monthpay' => '0',
			),
			array(
                'id' => '2',
                'discount' => '10',
                'pay_count' => '2',
                'loan' => '0',
                'name' => 'Дві проплати',
                'monthpay' => '0',
			),
            array(
                'id' => '3',
                'discount' => '8',
                'pay_count' => '4',
                'loan' => '0',
                'name' => '4 проплати',
                'monthpay' => '0',
            ),
            array(
                'id' => '4',
                'discount' => '0',
                'pay_count' => '12',
                'loan' => '0',
                'name' => 'Оплата за рік помісячно',
                'monthpay' => '12',
            ),
            array(
                'id' => '5',
                'discount' => '0',
                'pay_count' => '24',
                'loan' => '24',
                'name' => 'Кредитування на 2 роки',
                'monthpay' => '24',
            ),
            array(
                'id' => '6',
                'discount' => '0',
                'pay_count' => '36',
                'loan' => '24',
                'name' => 'Кредитування на 3 роки',
                'monthpay' => '36',
            ),
            array(
                'id' => '7',
                'discount' => '0',
                'pay_count' => '48',
                'loan' => '24',
                'name' => 'Кредитування на 4 роки',
                'monthpay' => '48',
            ),
            array(
                'id' => '8',
                'discount' => '0',
                'pay_count' => '60',
                'loan' => '24',
                'name' => 'Кредитування на 5 років',
                'monthpay' => '60',
            ),
		));
	}

	public function safeDown()
	{
		$this->dropTable('acc_payment_schema');
	}
}