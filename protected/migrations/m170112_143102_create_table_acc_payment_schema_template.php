<?php

class m170112_143102_create_table_acc_payment_schema_template extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('acc_payment_schema_template', array(
			'id' => 'pk',
			'template_name' => 'VARCHAR(64) NOT NULL COLLATE `utf8_bin`',
		));
		$this->insertMultiple('acc_payment_schema_template', array(
			array(
				'id' => '1',
				'template_name' => 'Схема проплат для курсів по замовчуванню(основна для курсів)',
			),
			array(
				'id' => '2',
				'template_name' => 'Схема проплат для модулів по замовчуванню(основна для модулів)',
			),
		));
		
		$this->createTable('acc_template_schemas', array(
			'id' => 'pk',
			'id_template' => 'INT(11) NOT NULL',
			'pay_count' => 'INT(11) NOT NULL DEFAULT "1" COMMENT "кількість проплат"',
			'discount' => 'DECIMAL(10,2) NOT NULL DEFAULT "0.00" COMMENT "відсоток знижки"',
			'loan' => 'DECIMAL(10,2) NOT NULL DEFAULT "0" COMMENT "відсоток"',
		));

		$this->insertMultiple('acc_template_schemas', array(
			array(
				'id' => '1',
				'id_template' => '1',
				'pay_count' => '1',
				'discount' => '30',
				'loan' => '0',
			),
			array(
				'id' => '2',
				'id_template' => '1',
				'pay_count' => '2',
				'discount' => '10',
				'loan' => '0',
			),
			array(
				'id' => '3',
				'id_template' => '1',
				'pay_count' => '4',
				'discount' => '8',
				'loan' => '0',
			),
			array(
				'id' => '4',
				'id_template' => '1',
				'pay_count' => '12',
				'discount' => '0',
				'loan' => '0',
			),
			array(
				'id' => '5',
				'id_template' => '1',
				'pay_count' => '24',
				'discount' => '0',
				'loan' => '24',
			),
			array(
				'id' => '6',
				'id_template' => '1',
				'pay_count' => '36',
				'discount' => '0',
				'loan' => '24',
			),
			array(
				'id' => '7',
				'id_template' => '1',
				'pay_count' => '48',
				'discount' => '0',
				'loan' => '24',
			),
			array(
				'id' => '8',
				'id_template' => '1',
				'pay_count' => '60',
				'discount' => '0',
				'loan' => '24',
			),
			array(
				'id' => '9',
				'id_template' => '2',
				'pay_count' => '1',
				'discount' => '0',
				'loan' => '0',
			),
		));
	}

	public function safeDown()
	{
		$this->dropTable('acc_payment_schema_template');
		$this->dropTable('acc_template_schemas');
	}
}