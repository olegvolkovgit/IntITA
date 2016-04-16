<?php

class m160409_122242_create_log_track_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('log_tracks', array(
                'id' => 'INT(10) AUTO_INCREMENT PRIMARY KEY',
                'event' => 'string',
                'lesson' => 'string',
                'user' => 'string',
                'part' => 'string',
                'logtime' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP'
            ));
	}

	public function down()
	{
		$this->dropTable('log_tracks');
		
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