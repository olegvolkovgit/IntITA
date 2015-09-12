<?php

class m150912_121254_delete_column_courses_graduate_table extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('graduate', 'courses');
	}

	public function down()
	{
		echo "m150912_121254_delete_column_courses_graduate_table does not support migration down.\n";
		return false;
	}
}