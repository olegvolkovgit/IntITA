<?php

class m170327_174247_teacher_table_update_and_add_organizations extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('teacher_organization', [
			'id_user' => 'INT(10) NOT NULL',
			'id_organization' => 'INT(10) NOT NULL',
			'isPrint' => 'BOOLEAN NOT NULL DEFAULT TRUE',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'assigned_by' => 'INT(10) NOT NULL',
			'cancelled_by' => 'INT(10) DEFAULT NULL',
		]);

		foreach (Teacher::model()->findAll() as $teacher){
			$this->insert('teacher_organization', array(
				'id_user' => $teacher->user_id,
				'id_organization' => 1,
				'isPrint' => $teacher->isPrint,
				'assigned_by' => 2,
			));
		}

		$this->addPrimaryKey('teacher_organization_pk', 'teacher_organization', ['id_user', 'id_organization']);
		$this->addForeignKey('FK_teacher_organization_user', 'teacher_organization', 'id_user', 'user', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('FK_teacher_organization_organization', 'teacher_organization', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('FK_teacher_organization_assigned_by', 'teacher_organization', 'assigned_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
		$this->addForeignKey('FK_teacher_organization_cancelled_by', 'teacher_organization', 'cancelled_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

		$this->dropForeignKey('FK_teacher_organization', 'teacher');
		$this->dropColumn('teacher', 'id_organization');
		$this->addForeignKey('FK_teacher_user', 'teacher', 'user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
		$this->dropColumn('teacher', 'isPrint');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_teacher_organization_cancelled_by', 'teacher_organization');
		$this->dropForeignKey('FK_teacher_organization_assigned_by', 'teacher_organization');
		$this->dropForeignKey('FK_teacher_organization_organization', 'teacher_organization');
		$this->dropForeignKey('FK_teacher_organization_user', 'teacher_organization');

		$this->dropPrimaryKey('teacher_organization_pk', 'teacher_organization');

		$this->dropTable('teacher_organization');

		$this->dropColumn('teacher', 'end_date');
		$this->dropForeignKey('FK_teacher_user', 'teacher');
		$this->dropIndex('FK_teacher_user', 'teacher');
		$this->dropPrimaryKey('teacher_pk', 'teacher');
		$this->addPrimaryKey('teacher_id', 'teacher',['teacher_id']);
	}
}