<?php

class m160414_210700_create_vc_tests_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("vc_tests", array(
			"id" => "INT PRIMARY KEY AUTO_INCREMENT",
			"id_lecture_element" => "INT NOT NULL",
			"title" => "VARCHAR(50) DEFAULT NULL",
            'CONSTRAINT `FK_test_lecture_element` FOREIGN KEY (`id_lecture_element`) REFERENCES `vc_lecture_element` (`id`)'
		));
	}

	public function down()
	{
		$this->dropTable("vc_tests");
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