<?php

class m161017_102208_create_table_user_super_visor extends CDbMigration
{
	public function up()
	{
		$this->createTable('user_super_visor', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'assigned_by' => 'INT(10) NOT NULL',
			'cancelled_by' => 'INT(10) DEFAULT NULL',
			'PRIMARY KEY (`id_user`)',
			'CONSTRAINT `FK_user_super_visor` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
	}

	public function down()
	{
		$this->dropForeignKey('FK_user_super_visor', 'user_super_visor');
		$this->dropTable('user_super_visor');
	}
}