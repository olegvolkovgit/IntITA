<?php

class m150826_142847_add_config_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('config', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'param' => 'varchar(128) NOT NULL',
            'value' => 'text NOT NULL',
            'default' => 'text NOT NULL',
            'label' => 'varchar(255) NOT NULL',
            'type' =>'varchar(128) NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('config');
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