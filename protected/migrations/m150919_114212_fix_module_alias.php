<?php

class m150919_114212_fix_module_alias extends CDbMigration
{
	public function up()
	{
        $this->update('module', array('alias' => ''));
	}

	public function down()
	{
		echo "m150919_114212_fix_module_alias does not support migration down.\n";
		return false;
	}
}