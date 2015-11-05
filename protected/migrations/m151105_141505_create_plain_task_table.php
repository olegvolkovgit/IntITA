<?php

class m151105_141505_create_plain_task_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('plain_task', array(
            'id' => 'pk',
            'block_element' => 'INT(10) NOT NULL',
            'author' => 'INT(10) NOT NULL'
        ));
	}


	public function down()
	{
        $this->dropTable('plain_task');
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