<?php

class m160325_196122_create_log_track_table extends CDbMigration
{
	public function up()
	{
            $this->createTable('log_tracks_of_events', array(
                'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
                'event' => 'string',
                'lesson' => 'string',
                'user' => 'string',
                'part' => 'string',
                'logtime' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP'
            ));
	}

	public function down()
	{
		$this->dropTable('log_tracks_of_events');
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