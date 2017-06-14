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
	}
}