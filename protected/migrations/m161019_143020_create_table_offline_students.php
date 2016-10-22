<?php

class m161019_143020_create_table_offline_students extends CDbMigration
{
	public function up()
	{
		$this->createTable('offline_students', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'graduate_date' => 'DATETIME NULL DEFAULT NULL',
			'id_subgroup' => 'INT(10) NOT NULL',
			'CONSTRAINT `FK_offline_students_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)',
			'CONSTRAINT `FK_offline_students_subgroup` FOREIGN KEY (`id_subgroup`) REFERENCES `offline_subgroups` (`id`)'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_offline_students_user','offline_students');
		$this->dropForeignKey('FK_offline_students_subgroup','offline_students');
		$this->dropTable('offline_students');
	}
}