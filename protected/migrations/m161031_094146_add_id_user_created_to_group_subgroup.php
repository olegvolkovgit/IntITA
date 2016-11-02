<?php

class m161031_094146_add_id_user_created_to_group_subgroup extends CDbMigration
{
	public function up()
	{
		$this->addColumn('offline_groups', 'id_user_created', "INT NOT NULL DEFAULT 0");
		$this->addColumn('offline_subgroups', 'id_user_created', "INT NOT NULL DEFAULT 0");
		$this->addColumn('offline_groups', 'id_user_curator', "INT NOT NULL DEFAULT 0");
		$this->addColumn('offline_subgroups', 'id_user_curator', "INT NOT NULL DEFAULT 0");
		
		$this->update('offline_groups', array('id_user_created' => '38'));
		$this->update('offline_subgroups', array('id_user_created' => '38'));
		$this->update('offline_groups', array('id_user_curator' => '38'));
		$this->update('offline_subgroups', array('id_user_curator' => '38'));
	}

	public function down()
	{
		$this->dropColumn('offline_groups', 'id_user_created');
		$this->dropColumn('offline_subgroups', 'id_user_created');
		$this->dropColumn('offline_groups', 'id_user_curator');
		$this->dropColumn('offline_subgroups', 'id_user_curator');
	}
}