<?php

class m150929_125420_create_temp_pay_table extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('temp_pay', array(
            'id_account' => 'pk',
            'id_user' => 'INT(11) NOT NULL',
            'date' => 'INT(11) NOT NULL',
            'id_course' => 'INT(11) NULL DEFAULT NULL',
            'id_module' => 'INT(11) NULL DEFAULT NULL',
            'summa' => 'FLOAT NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('temp_pay');
	}
}