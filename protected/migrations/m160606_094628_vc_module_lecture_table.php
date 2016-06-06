<?php

class m160606_094628_vc_module_lecture_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("vc_module_lecture", array(
			"id" => "INT PRIMARY KEY AUTO_INCREMENT",
			"id_lecture_revision" =>  "INT DEFAULT NULL",
			"id_module_revision" => "INT NOT NULL",
			"lecture_order" => "INT NOT NULL",

			'CONSTRAINT `FK_module_lecture_module` FOREIGN KEY (`id_module_revision`) REFERENCES `vc_module` (`id_module_revision`)'
		));
	}

	public function safeDown()
	{
		$this->dropTable("vc_module_lecture");
	}
}