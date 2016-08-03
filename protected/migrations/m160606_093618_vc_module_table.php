<?php

class m160606_093618_vc_module_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("vc_module", array(
			"id_module_revision" => "INT PRIMARY KEY AUTO_INCREMENT",
			"id_parent" => "INT DEFAULT NULL",
			"id_module" => "INT DEFAULT NULL",
			"id_properties" => "INT DEFAULT NULL",
			"INDEX(`id_properties`)",
			'CONSTRAINT `FK_module_module_properties` FOREIGN KEY (`id_properties`) REFERENCES `vc_module_properties` (`id`)'
		));
	}

	public function safeDown()
	{
		$this->dropTable("vc_module");
	}
}