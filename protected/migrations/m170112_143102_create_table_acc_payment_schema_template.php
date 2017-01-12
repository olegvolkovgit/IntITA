<?php

class m170112_143102_create_table_acc_payment_schema_template extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('acc_payment_schema_template', array(
			'id' => 'pk',
			'id_template' => 'INT(11) NOT NULL',
			'template_name' => 'VARCHAR(64) NOT NULL COLLATE `utf8_bin`',
			'discount' => 'DECIMAL(10,2) NOT NULL DEFAULT "0.00" COMMENT "відсоток знижки"',
			'pay_count' => 'INT(11) NOT NULL DEFAULT "1" COMMENT "кількість проплат"',
			'loan' => 'DECIMAL(10,0) NOT NULL DEFAULT "0" COMMENT "відсоток"',
			'name' => 'VARCHAR(512) NOT NULL COMMENT "опис" COLLATE `utf8_bin`',
		));
	}

	public function safeDown()
	{
		$this->dropTable('acc_payment_schema_template');
	}
}