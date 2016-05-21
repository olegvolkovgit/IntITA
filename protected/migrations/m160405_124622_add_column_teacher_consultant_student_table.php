<?php

class m160405_124622_add_column_teacher_consultant_student_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('teacher_consultant_student', 'id_module', 'INT(10) NOT NULL');
        $this->addForeignKey('FK_teacher_consultant_student_module', 'teacher_consultant_student', 'id_module', 'module', 'module_ID');
	}

	public function down()
	{
		$this->dropForeignKey('FK_teacher_consultant_student_module', 'teacher_consultant_student');
        $this->dropColumn('teacher_consultant_student', 'id_module');
	}
}