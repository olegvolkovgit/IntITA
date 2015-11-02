<?php

class m151024_115736_add_modules_status extends CDbMigration
{

	public function safeUp()
	{
	    $this->addColumn('module', 'status', 'TINYINT DEFAULT 0');
	}

	public function safeDown()
	{
	    $this->dropColumn('module', 'status');
	}

}