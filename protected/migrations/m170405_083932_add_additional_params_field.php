<?php

class m170405_083932_add_additional_params_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn('scheduler_tasks','parameters','TEXT NULL DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('scheduler_tasks','parameters');
		return true;
	}

}