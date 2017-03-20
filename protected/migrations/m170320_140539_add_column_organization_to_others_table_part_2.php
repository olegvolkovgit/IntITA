<?php

class m170320_140539_add_column_organization_to_others_table_part_2 extends CDbMigration
{
	public function safeUp()
	{
		$this->dropForeignKey('FK_user_admin_user', 'user_admin');
		$this->dropForeignKey('FK_user_admin_organization', 'user_admin');
		$this->alterColumn('user_admin', 'id_user', 'INT(10) NOT NULL');
		$this->dropPrimaryKey('id_user', 'user_admin');
		$this->addPrimaryKey('user_admin_pk', 'user_admin', ['id_user', 'start_date', 'id_organization']);
		$this->addForeignKey('FK_user_admin_organization', 'user_admin', 'id_organization', 'organization', 'id');
		$this->addForeignKey('FK_user_admin_user', 'user_admin', 'id_user', 'user', 'id');

		$this->addColumn('user_super_visor', 'id_organization', 'INT(10) NOT NULL');
		$this->update('user_super_visor', array('id_organization' => 1));
		$this->dropForeignKey('FK_user_super_visor', 'user_super_visor');
		$this->addPrimaryKey('user_super_visor_pk', 'user_super_visor', ['id_user', 'start_date', 'id_organization']);
		$this->addForeignKey('FK_user_super_visor_organization', 'user_super_visor', 'id_organization', 'organization', 'id');
		$this->addForeignKey('FK_user_super_visor', 'user_super_visor', 'id_user', 'user', 'id');

		$this->alterColumn('user_accountant', 'id_user', 'INT(10) NOT NULL');
		$this->dropPrimaryKey('id_user', 'user_accountant');
		$this->addColumn('user_accountant', 'id_organization', 'INT(10) NOT NULL');
		$this->update('user_accountant', array('id_organization' => 1));
		$this->addPrimaryKey('user_accountant_pk', 'user_accountant', ['id_user', 'start_date', 'id_organization']);
		$this->addForeignKey('FK_user_accountant_organization', 'user_accountant', 'id_organization', 'organization', 'id');

		$this->addColumn('user_content_manager', 'id_organization', 'INT(10) NOT NULL');
		$this->update('user_content_manager', array('id_organization' => 1));
		$this->dropForeignKey('FK_user_content_manager_user', 'user_content_manager');
		$this->dropPrimaryKey('id_user', 'user_content_manager');
		$this->addPrimaryKey('user_content_manager_pk', 'user_content_manager', ['id_user', 'start_date', 'id_organization']);
		$this->addForeignKey('FK_user_content_manager_organization', 'user_content_manager', 'id_organization', 'organization', 'id');
		$this->addForeignKey('FK_user_content_manager_user', 'user_content_manager', 'id_user', 'user', 'id');

		$this->addColumn('user_trainer', 'id_organization', 'INT(10) NOT NULL');
		$this->update('user_trainer', array('id_organization' => 1));
		$this->dropForeignKey('FK_user_trainer_user', 'user_trainer');
		$this->dropPrimaryKey('id_user', 'user_trainer');
		$this->addPrimaryKey('user_trainer_pk', 'user_trainer', ['id_user', 'start_date', 'id_organization']);
		$this->addForeignKey('FK_user_trainer_organization', 'user_trainer', 'id_organization', 'organization', 'id');
		$this->addForeignKey('FK_user_trainer_user', 'user_trainer', 'id_user', 'user', 'id');

		$this->addColumn('user_author', 'id_organization', 'INT(10) NOT NULL');
		$this->update('user_author', array('id_organization' => 1));
		$this->dropForeignKey('FK_user_author', 'user_author');
		$this->dropPrimaryKey('id_user', 'user_author');
		$this->addPrimaryKey('user_author_pk', 'user_author', ['id_user', 'start_date', 'id_organization']);
		$this->addForeignKey('FK_user_author_organization', 'user_author', 'id_organization', 'organization', 'id');
		$this->addForeignKey('FK_user_author', 'user_author', 'id_user', 'user', 'id');

		$this->addColumn('user_teacher_consultant', 'id_organization', 'INT(10) NOT NULL');
		$this->update('user_teacher_consultant', array('id_organization' => 1));
		$this->dropForeignKey('FK_user_teacher_consultant_user', 'user_teacher_consultant');
		$this->dropPrimaryKey('id_user', 'user_teacher_consultant');
		$this->addPrimaryKey('user_teacher_consultant_pk', 'user_teacher_consultant', ['id_user', 'start_date', 'id_organization']);
		$this->addForeignKey('FK_user_teacher_consultant_organization', 'user_teacher_consultant', 'id_organization', 'organization', 'id');
		$this->addForeignKey('FK_user_teacher_consultant_user', 'user_teacher_consultant', 'id_user', 'user', 'id');

		$this->addColumn('user_tenant', 'id_organization', 'INT(10) NOT NULL');
		$this->update('user_tenant', array('id_organization' => 1));
		$this->addForeignKey('FK_user_tenant_organization', 'user_tenant', 'id_organization', 'organization', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_user_admin_user', 'user_admin');
		$this->dropForeignKey('FK_user_admin_organization', 'user_admin');
		$this->dropPrimaryKey('user_admin_pk', 'user_admin');
		$this->addPrimaryKey('user_admin_pk', 'user_admin', ['id_user', 'start_date']);
		$this->addForeignKey('FK_user_admin_organization', 'user_admin', 'id_organization', 'organization', 'id');
		$this->addForeignKey('FK_user_admin_user', 'user_admin', 'id_user', 'user', 'id');

		$this->dropForeignKey('FK_user_super_visor_organization', 'user_super_visor');
		$this->dropForeignKey('FK_user_super_visor', 'user_super_visor');
		$this->dropPrimaryKey('user_super_visor_pk', 'user_super_visor');
		$this->dropColumn('user_super_visor', 'id_organization');
		$this->addForeignKey('FK_user_super_visor', 'user_super_visor', 'id_user', 'user', 'id');

		$this->dropForeignKey('FK_user_accountant_organization', 'user_accountant');
		$this->dropPrimaryKey('user_accountant_pk', 'user_accountant');
		$this->dropColumn('user_accountant', 'id_organization');
		$this->addPrimaryKey('user_accountant_pk', 'user_accountant', ['id_user', 'start_date']);

		$this->dropForeignKey('FK_user_content_manager_organization', 'user_content_manager');
		$this->dropForeignKey('FK_user_content_manager_user', 'user_content_manager');
		$this->dropPrimaryKey('user_content_manager_pk', 'user_content_manager');
		$this->dropColumn('user_content_manager', 'id_organization');
		$this->addPrimaryKey('user_content_manager_pk', 'user_content_manager', ['id_user', 'start_date']);
		$this->addForeignKey('FK_user_content_manager_user', 'user_content_manager', 'id_user', 'user', 'id');

		$this->dropForeignKey('FK_user_trainer_organization', 'user_trainer');
		$this->dropForeignKey('FK_user_trainer_user', 'user_trainer');
		$this->dropPrimaryKey('user_trainer_pk', 'user_trainer');
		$this->dropColumn('user_trainer', 'id_organization');
		$this->addPrimaryKey('user_trainer_pk', 'user_trainer', ['id_user', 'start_date']);
		$this->addForeignKey('FK_user_trainer_user', 'user_trainer', 'id_user', 'user', 'id');

		$this->dropForeignKey('FK_user_author_organization', 'user_author');
		$this->dropForeignKey('FK_user_author', 'user_author');
		$this->dropPrimaryKey('user_author_pk', 'user_author');
		$this->dropColumn('user_author', 'id_organization');
		$this->addPrimaryKey('user_author_pk', 'user_author', ['id_user', 'start_date']);
		$this->addForeignKey('FK_user_author', 'user_author', 'id_user', 'user', 'id');

		$this->dropForeignKey('FK_user_teacher_consultant_organization', 'user_teacher_consultant');
		$this->dropForeignKey('FK_user_teacher_consultant_user', 'user_teacher_consultant');
		$this->dropPrimaryKey('user_teacher_consultant_pk', 'user_teacher_consultant');
		$this->dropColumn('user_teacher_consultant', 'id_organization');
		$this->addPrimaryKey('user_teacher_consultant_pk', 'user_teacher_consultant', ['id_user', 'start_date']);
		$this->addForeignKey('FK_user_teacher_consultant_user', 'user_teacher_consultant', 'id_user', 'user', 'id');

		$this->dropForeignKey('FK_user_tenant_organization', 'user_tenant');
		$this->dropColumn('user_tenant', 'id_organization');
	}
}