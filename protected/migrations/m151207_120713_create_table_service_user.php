<?php

class m151207_120713_create_table_service_user extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('service_user',array(
            'service_id' => 'INT(10)  NOT NULL ',
            'user_id' => 'INT(10) NOT NULL ',
        ));
	}

	public function safeDown()
	{
        $this->dropTable('service_user');
	}

}