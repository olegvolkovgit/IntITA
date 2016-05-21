<?php

class m160401_131331_delete_unused_columns_module_course_tables extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('course', 'course_duration_hours');
        $this->dropColumn('module', 'module_duration_hours');
        $this->dropColumn('module', 'module_duration_days');
	}

	public function down()
	{
		echo "m160401_131331_delete does not support migration down.\n";
		return false;
	}
}