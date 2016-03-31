<?php

class m160310_082252_create_vc_lecture_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("vc_lecture", array(
			"id_revision" => "INT PRIMARY KEY AUTO_INCREMENT",
			"id_parent" => "INT DEFAULT NULL",
			"id_lecture" => "INT DEFAULT NULL",
			"id_module" => "INT DEFAULT NULL",
			"id_properties" => "INT DEFAULT NULL",
			"INDEX(`id_properties`)",
			'CONSTRAINT `FK_lecture_lecture_properties` FOREIGN KEY (`id_properties`) REFERENCES `vc_lecture_properties` (`id`)'
        ));
	}

	public function down()
	{
		$this->dropTable("vc_lecture");
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