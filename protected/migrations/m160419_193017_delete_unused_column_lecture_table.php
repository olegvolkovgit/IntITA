<?php

class m160419_193017_delete_unused_column_lecture_table extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('lectures', 'idTeacher');
	}

	public function down()
	{
		echo "m160419_193017_delete_unused_column_lecture_table does not support migration down.\n";
		return false;
	}
}