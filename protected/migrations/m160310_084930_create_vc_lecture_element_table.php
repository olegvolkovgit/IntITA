<?php

class m160310_084930_create_vc_lecture_element_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("vc_lecture_element", array(
			"id" => "INT PRIMARY KEY AUTO_INCREMENT",
			"id_page" => "INT NOT NULL",
			"id_type" => "INT NOT NULL",
			"block_order" => "INT NOT NULL",
			"html_block" => "TEXT",
			'CONSTRAINT `FK_lecture_element_lecture_page` FOREIGN KEY (`id_page`) REFERENCES `vc_lecture_page` (`id`)'
		));
	}

	public function down()
	{
		$this->dropTable("vc_lecture_element");
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