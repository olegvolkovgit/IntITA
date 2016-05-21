<?php

class m160330_172230_create_table_user_teacher_consultant extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_teacher_consultant', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'capacity' => 'INT(11) NULL DEFAULT NULL',
            'PRIMARY KEY (`id_user`, `start_date`)',
			'CONSTRAINT `FK_user_teacher_consultant_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
	}
	public function safeDown()
	{
		$this->dropForeignKey('FK_user_teacher_consultant_user', 'teacher_consultant');
		$this->dropTable('teacher_consultant');
	}
}