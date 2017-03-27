<?php

class m170327_135203_add_organization_to_trainer_student extends CDbMigration
{
	public function safeUp() {
        $this->dropForeignKey('FK_trainer_student_user', 'trainer_student');
        $this->dropIndex('FK_trainer_student_teacher', 'trainer_student');
		$this->dropIndex('FK_trainer_student_user', 'trainer_student');

		$this->addColumn('trainer_student', 'id_organization', 'INT(10) NOT NULL');
		$this->update('trainer_student', array('id_organization' => 1));

		$this->addPrimaryKey('trainer_student_pk', 'trainer_student', ['trainer', 'student', 'start_time', 'id_organization']);
		$this->addForeignKey('FK_trainer_student_teacher', 'trainer_student', 'trainer', 'user', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('FK_trainer_student_organization', 'trainer_student', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('FK_trainer_student_user', 'trainer_student', 'student', 'user', 'id', 'RESTRICT', 'RESTRICT');
	}

	public function safeDown() {
		$this->dropForeignKey('FK_trainer_student_teacher', 'trainer_student');
		$this->dropForeignKey('FK_trainer_student_organization', 'trainer_student');
		$this->dropForeignKey('FK_trainer_student_user', 'trainer_student');

		$this->addPrimaryKey('trainer_student_pk', 'trainer_student', ['trainer', 'student', 'start_time', 'id_organization']);
	}
}