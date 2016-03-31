<?php

class m160310_082251_create_vc_lecture_properties_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("vc_lecture_properties", array(
			"id" => "INT PRIMARY KEY AUTO_INCREMENT",
			"image" => "VARCHAR(255)",
			"alias" => "VARCHAR(10)",
            "order" => "INT NOT NULL",
            "id_type" => "INT NOT NULL",
            "is_free" => "INT NOT NULL",
            "title_ua" => "VARCHAR(255)",
            "title_ru" => "VARCHAR(255)",
            "title_en" => "VARCHAR(255)",

			"start_date" => "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
			"id_user_created" => "INT",

            "update_date" => "TIMESTAMP",
            "id_user_updated" => "INT",

			"send_approval_date" => "TIMESTAMP",
			"id_user_sended_approval" => "INT",

			"reject_date" => "TIMESTAMP",
			"id_user_rejected" => "INT",

			"approve_date" => "TIMESTAMP",
			"id_user_approved" => "INT",

			"end_date" => "TIMESTAMP",
			"id_user_cancelled" => "INT",
		));
	}

	public function down()
	{
        $this->dropTable("vc_lecture_properties");
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