<?php

class m160303_164222_create_vc_text_block_history_table extends CDbMigration
{
	public function up() {
		$this->createTable("vc_text_block_history", array(
			"id" => "INT PRIMARY KEY AUTO_INCREMENT",
			"id_parent" => "INT DEFAULT NULL",
			"id_block" => "INT NOT NULL",
			"id_type" => "INT NOT NULL",
			"html_block" => "TEXT",
			"start_date" => "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
			"id_user_created" => "INT",
			"approve_date" => "TIMESTAMP",
			"id_user_approved" => "INT",
			"end_date" => "TIMESTAMP",
			"id_user_cancelled" => "INT",
		));
	}

	public function down()
	{
        $this->dropTable('vc_text_block_history');
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