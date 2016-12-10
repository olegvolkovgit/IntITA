<?php

class m161114_104345_create_table_user_author extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_author', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'assigned_by' => 'INT(10) NOT NULL',
			'cancelled_by' => 'INT(10) DEFAULT NULL',
			'PRIMARY KEY (`id_user`, `start_date`)',
			'CONSTRAINT `FK_user_author` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_user_author', 'user_author');
		$this->dropTable('user_author');
	}
}