<?php

class m170111_113029_update_group_and_subgroup_tables extends CDbMigration
{
	public function up()
	{
		$this->renameColumn('offline_groups', 'id_user_curator', 'chat_author_id');

		$this->update('offline_subgroups', array('id_trainer'=> new CDbExpression('id_user_curator')), 'id_trainer is NULL');
		$this->dropColumn('offline_subgroups', 'id_user_curator');
		$this->alterColumn('offline_subgroups', 'id_trainer', 'INT(10) NOT NULL');
	}

	public function down()
	{
		$this->renameColumn('offline_groups', 'chat_author_id', 'id_user_curator');

		$this->alterColumn('offline_subgroups', 'id_trainer', 'INT(10) DEFAULT NULL');
		$this->addColumn('offline_subgroups', 'id_user_curator', "INT(10) NOT NULL");
		$this->update('offline_subgroups', array('id_user_curator'=> 300));
	}
}