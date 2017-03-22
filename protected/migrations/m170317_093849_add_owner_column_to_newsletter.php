<?php

class m170317_093849_add_owner_column_to_newsletter extends CDbMigration
{
	public function up()
	{
		$this->addColumn('scheduler_tasks','owner','INT(11) DEFAULT NULL');
		$this->update('scheduler_tasks', array('owner' => '1'));
	}

	public function down()
	{
		echo "m170317_093849_add_owner_column_to_newsletter goes down.\n";
		$this->dropColumn('scheduler_tasks','owner');
		return true;
	}

}