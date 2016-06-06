<?php

class m160606_090357_vc_module_properties_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("vc_module_properties", array(
			"id" => "INT PRIMARY KEY AUTO_INCREMENT",
			"title_ua" => "VARCHAR(255) NOT NULL",
			"title_ru" => "VARCHAR(255)",
			"title_en" => "VARCHAR(255)",
			"alias" => "VARCHAR(10) NOT NULL",
			"language" => "VARCHAR(6) NOT NULL",
			"module_price" => "DECIMAL(10)",
			"for_whom" => "TEXT",
			"what_you_learn" => "TEXT",
			"what_you_get" => "TEXT",
			"module_img" => "VARCHAR(255)",
			"level" => "INT(11) NOT NULL",
			"hours_in_day" => "INT(11)",
			"days_in_week" => "INT(11)",
			"rating" => "TINYINT(2)",
			"module_number" => "INT(10)",
			"cancelled" => "TINYINT(1) NOT NULL",
			"status" => "TINYINT(1) NOT NULL",
			"price_offline" => "DECIMAL(10)",

			"start_date" => "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
			"id_user_created" => "INT",

			"update_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_updated" => "INT",

			"send_approval_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_sended_approval" => "INT",

			"reject_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_rejected" => "INT",

			"approve_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_approved" => "INT",

			"end_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_cancelled" => "INT",

			"release_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_released" => "INT",

			"cancel_edit_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_cancelled_edit" => "INT",
		));
	}

	public function safeDown()
	{
		$this->dropTable("vc_module_properties");
	}
}