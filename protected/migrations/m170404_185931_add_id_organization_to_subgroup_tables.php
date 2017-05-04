<?php

class m170404_185931_add_id_organization_to_subgroup_tables extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('offline_groups', 'id_organization', 'INT(10) NOT NULL');
		$this->update('offline_groups', array('id_organization' => 1));
		$this->addForeignKey('FK_offline_groups_organization', 'offline_groups', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');

		$this->dropColumn('offline_groups', 'id_user_curator');
		$this->dropColumn('offline_subgroups', 'id_user_curator');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_offline_groups_organization', 'offline_groups');
		
		$this->dropColumn('offline_groups', 'id_organization');
	}
}