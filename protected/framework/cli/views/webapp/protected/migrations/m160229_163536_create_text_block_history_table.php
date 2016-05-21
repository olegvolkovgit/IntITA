<?php

class m160229_163536_create_text_block_history_table extends CDbMigration
{
	public function up() {
        $this->createTable("text_block_history", array(
            "id" => "INT PRIMARY KEY AUTO_INCREMENT",
            "id_block" => "INT NOT NULL",
            "id_type" => "INT NOT NULL",
            "html_block" => "TEXT",
            "start_date" => "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
            "id_user_started" => "INT",
            "approve_date" => "TIMESTAMP",
            "id_user_approved" => "INT",
            "end_date" => "TIMESTAMP",
			"id_user_ended" => "INT",
			"comment" => "TEXT"
        ));
	}

	public function down()
	{
        $this->dropTable('text_block_history');
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