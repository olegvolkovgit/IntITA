<?php

class m160213_091059_create_user_student_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('user_student', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'CONSTRAINT `FK_user_student_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
	}
	public function down()
	{
		$this->dropForeignKey('FK_user_student_user', 'user_student');
		$this->dropTable('user_student');
	}
}