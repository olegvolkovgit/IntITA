<?php

class m170314_103729_add_column_organization_to_others_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('course', 'id_organization', 'INT(10) NOT NULL');
		$this->update('course', array('id_organization' => 1));
		$this->addForeignKey('FK_course_organization', 'course', 'id_organization', 'organization', 'id');
		
		$this->addColumn('module', 'id_organization', 'INT(10) NOT NULL');
		$this->update('module', array('id_organization' => 1));
		$this->addForeignKey('FK_module_organization', 'module', 'id_organization', 'organization', 'id');

		$this->addColumn('teacher', 'id_organization', 'INT(10) NOT NULL');
		$this->update('teacher', array('id_organization' => 1));
		$this->addForeignKey('FK_teacher_organization', 'teacher', 'id_organization', 'organization', 'id');

		$this->addColumn('user_admin', 'id_organization', 'INT(10) NOT NULL');
		$this->update('user_admin', array('id_organization' => 1));
		$this->addForeignKey('FK_user_admin_organization', 'user_admin', 'id_organization', 'organization', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_course_organization', 'course');
		$this->dropColumn('course', 'id_organization');
		
		$this->dropForeignKey('FK_module_organization', 'module');
		$this->dropColumn('module', 'id_organization');
		
		$this->dropForeignKey('FK_teacher_organization', 'teacher');
		$this->dropColumn('teacher', 'id_organization');

		$this->dropForeignKey('FK_user_admin_organization', 'user_admin');
		$this->dropColumn('user_admin', 'id_organization');
	}
}