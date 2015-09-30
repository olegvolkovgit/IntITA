<?php

class m150929_125420_create_temp_pay_table extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('temp_pay', array(
            'id_account' => 'pk',
            'id_user' => 'INT(10) NOT NULL',
            'date' => 'TIMESTAMP NOT NULL',
            'id_course' => 'INT(10) NULL DEFAULT NULL',
            'id_module' => 'INT(10) NULL DEFAULT NULL',
            'summa' => 'INT(11) NOT NULL',
        ));
        $this->addForeignKey('FK_temp_pay_user', 'temp_pay', 'id_user', 'user', 'id');
        $this->addForeignKey('FK_temp_pay_module', 'temp_pay', 'id_module', 'module', 'module_ID');
        $this->addForeignKey('FK_temp_pay_course', 'temp_pay', 'id_course', 'course', 'course_ID');
	}

	public function down()
	{
        $this->dropTable('temp_pay');
	}
}