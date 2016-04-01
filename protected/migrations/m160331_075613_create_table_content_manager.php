<?php

class m160331_075613_create_table_content_manager extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_content_manager', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'PRIMARY KEY (`id_user`, `start_date`)',
			'CONSTRAINT `FK_user_content_manager_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
	}
	public function safeDown()
	{
		$this->dropForeignKey('FK_user_content_manager_user', 'user_content_manager');
		$this->dropTable('user_content_manager');
	}
}