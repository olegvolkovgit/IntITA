<?php

class m161024_182304_update_table_offline_students extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('offline_students', 'start_date', 'DATE DEFAULT NULL');
		$this->alterColumn('offline_students', 'graduate_date', 'DATE DEFAULT NULL');
	}

	public function down()
	{
		echo "m161024_182304_update_table_offline_students does not support migration down.\n";
		return false;
	}
}