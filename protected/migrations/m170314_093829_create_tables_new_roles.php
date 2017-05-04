<?php

class m170314_093829_create_tables_new_roles extends CDbMigration
{
	public function up()
	{
		$this->createTable('user_director', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'assigned_by' => 'INT(10) NOT NULL',
			'cancelled_by' => 'INT(10) DEFAULT NULL',
			'CONSTRAINT `FK_user_director` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));

		$this->insertMultiple('user_director', array(
			array(
				'id_user' => '45',
				'assigned_by' => '45',
			),
			array(
				'id_user' => '319',
				'assigned_by' => '45',
			),
		));

		$this->createTable('user_super_admin', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'assigned_by' => 'INT(10) NOT NULL',
			'cancelled_by' => 'INT(10) DEFAULT NULL',
			'CONSTRAINT `FK_user_super_admin` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));

		$this->createTable('user_auditor', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'assigned_by' => 'INT(10) NOT NULL',
			'cancelled_by' => 'INT(10) DEFAULT NULL',
			'CONSTRAINT `FK_user_auditor` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
	}

	public function down()
	{
		$this->dropForeignKey('FK_user_director', 'user_director');
		$this->dropTable('user_director');

		$this->dropForeignKey('FK_user_super_admin', 'user_super_admin');
		$this->dropTable('user_super_admin');
		
		$this->dropForeignKey('FK_user_auditor', 'user_auditor');
		$this->dropTable('user_auditor');
	}
}