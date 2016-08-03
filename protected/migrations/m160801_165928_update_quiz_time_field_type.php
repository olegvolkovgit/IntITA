<?php

class m160801_165928_update_quiz_time_field_type extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('tests_marks', 'time', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('plain_task_marks', 'time', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
	}

	public function down()
	{
		echo "m160801_165928_update_quiz_time_field_type does not support migration down.\n";
		return false;
	}
}