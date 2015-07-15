<?php

class m150714_145200_create_task_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('task', array(
            'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'language' => 'VARCHAR(15) NULL DEFAULT NULL',
            'assignment' => 'INT(10) NULL DEFAULT NULL',
            'condition' => 'INT(11) NOT NULL',
            'author' => 'INT(11) NULL DEFAULT NULL',

        ));
	}

	public function down()
	{
        $this->dropTable('task');
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