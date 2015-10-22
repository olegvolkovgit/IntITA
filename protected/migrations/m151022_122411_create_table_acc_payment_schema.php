<?php

class m151022_122411_create_table_acc_payment_schema extends CDbMigration
{
	public function up()
	{
        $this->createTable('acc_payment_schema', array(
            'id' => 'pk',
            'discount' => 'DECIMAL(10,2) NOT NULL DEFAULT `0.00` COMMENT `відсоток знижки`',
            'pay_count' => 'INT(11) NOT NULL DEFAULT `1` COMMENT `кількість проплат`',
            'loan' => 'DECIMAL(10,0) NOT NULL DEFAULT `0` COMMENT `відсоток`',
            'name' => 'VARCHAR(512) NOT NULL COMMENT `опис` COLLATE `utf8_bin`',
            'monthpay' => 'TINYINT(1) NOT NULL DEFAULT `0`',
        ));
	}

	public function safeDown()
	{
		$this->dropTable('acc_payment_schema');
	}
}