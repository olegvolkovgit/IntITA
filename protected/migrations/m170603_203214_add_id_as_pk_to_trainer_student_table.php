<?php

class m170603_203214_add_id_as_pk_to_trainer_student_table extends CDbMigration
{
    public function safeUp() {
        $this->dropForeignKey('FK_trainer_student_teacher', 'trainer_student');
        $this->dropForeignKey('FK_trainer_student_organization', 'trainer_student');
        $this->dropForeignKey('FK_trainer_student_user', 'trainer_student');

        $this->dropPrimaryKey('trainer_student_pk', 'trainer_student');

        $this->addColumn('trainer_student', 'id', 'INT PRIMARY KEY AUTO_INCREMENT');

        $this->addForeignKey('FK_trainer_student_teacher', 'trainer_student', 'trainer', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_trainer_student_organization', 'trainer_student', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_trainer_student_user', 'trainer_student', 'student', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown() {
        $this->dropColumn('trainer_student', 'id');

        $this->addPrimaryKey('trainer_student_pk', 'trainer_student', ['trainer', 'student', 'start_time', 'id_organization']);
        $this->addForeignKey('FK_trainer_student_teacher', 'trainer_student', 'trainer', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_trainer_student_organization', 'trainer_student', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_trainer_student_user', 'trainer_student', 'student', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }
}