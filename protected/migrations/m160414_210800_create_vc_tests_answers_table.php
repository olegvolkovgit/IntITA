<?php

class m160414_210800_create_vc_tests_answers_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("vc_tests_answers", array(
			"id" => "INT PRIMARY KEY AUTO_INCREMENT",
			"id_test" => "INT NOT NULL",
			"answer" => "TEXT NOT NULL",
            "is_valid" => "TINYINT(4) NOT NULL",
            'CONSTRAINT `FK_test_answer_test` FOREIGN KEY (`id_test`) REFERENCES `vc_tests` (`id`)'
		));
	}

	public function down()
	{
		$this->dropTable("vc_tests_answers");
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