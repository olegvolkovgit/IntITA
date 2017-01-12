<?php

class m170112_114326_alter_column_educform_in_user_table extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('user', 'educform', 'tinyint(1) DEFAULT 1');
	}

	public function down()
	{
		echo "m170112_114326_alter_column_educform_in_user_table does not support migration down.\n";
		return false;
	}
}