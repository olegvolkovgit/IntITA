<?php

class m160310_084917_create_vc_lecture_page_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("vc_lecture_page", array(
			"id" => "INT PRIMARY KEY AUTO_INCREMENT",
            "id_page" => "INT DEFAULT NULL",
			"id_parent_page" =>  "INT DEFAULT NULL",
			"id_revision" => "INT NOT NULL",
			"page_title" => "VARCHAR(255)",
			"page_order" => "INT NOT NULL",
			"video" => "INT DEFAULT NULL",
			"quiz" => "INT DEFAULT NULL",

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
			'CONSTRAINT `FK_lecture_page_lecture` FOREIGN KEY (`id_revision`) REFERENCES `vc_lecture` (`id_revision`)'
		));
	}

	public function down()
	{
		$this->dropTable("vc_lecture_page");
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