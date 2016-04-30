<?php

class m160401_124220_create_table_teacher_consultant_student extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('teacher_consultant_student', array(
			'id_teacher' => 'INT(10) NOT NULL',
			'id_student' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'INDEX `FK_teacher_consultant_student_user` (`id_teacher`)',
			'INDEX `FK_teacher_consultant_student_user_2` (`id_student`)',
			'CONSTRAINT `FK_teacher_consultant_student_user` FOREIGN KEY (`id_student`) REFERENCES `user` (`id`)',
			'CONSTRAINT `FK_teacher_consultant_student_user_2` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`)'
		), 'COLLATE=\'utf8_general_ci\' ENGINE=InnoDB');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_teacher_consultant_student_user', 'teacher_consultant_student');
		$this->dropForeignKey('FK_teacher_consultant_student_user_2', 'teacher_consultant_student');
		$this->dropTable('teacher_consultant_student');
	}
}