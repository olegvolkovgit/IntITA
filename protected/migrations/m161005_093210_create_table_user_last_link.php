<?php

class m161005_093210_create_table_user_last_link extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_last_link', array(
			'id_user' => 'INT(10) NOT NULL',
			'last_link' => 'VARCHAR(255) NULL DEFAULT NULL',
			'PRIMARY KEY (`id_user`)',
			'CONSTRAINT `FK_user_last_link_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_user_last_link_user', 'user_last_link');
		$this->dropTable('user_last_link');
	}
}