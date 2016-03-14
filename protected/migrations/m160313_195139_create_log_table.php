<?php

class m160313_195139_create_log_table extends CDbMigration
{
	public function up()
	{
            $this->createTable('log_actions', array(
                'id' => 'pk',
                'controller' => 'string',
                'action' => 'string',
                'address' => 'string',
                'user' => 'string',
                'params' => 'text',
                'route'  => 'string',
                'logtime' => 'timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ));
	}

	public function down()
	{
		echo "m160313_195139_create_log_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}