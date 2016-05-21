<?php

class m160423_080137_FK_event_log_track extends CDbMigration
{
	public function up()
	{
		$this->truncateTable('log_tracks');
		$this->addForeignKey('FK_tracking_of_events', 'log_tracks', 'event_id','events_name', 'event_id');
	}

	public function down()
	{
		$this->dropForeignKey('FK_tracking_of_events','log_tracks');
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