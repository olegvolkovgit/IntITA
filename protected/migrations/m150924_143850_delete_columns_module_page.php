<?php

class m150924_143850_delete_columns_module_page extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('module', 'about_module');
        $this->dropColumn('module', 'owners');
	}

	public function down()
	{
		echo "m150924_143850_delete_columns_module_page does not support migration down.\n";
		return false;
	}
}