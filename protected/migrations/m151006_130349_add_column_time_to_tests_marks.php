<?php

class m151006_130349_add_column_time_to_tests_marks extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('tests_marks', 'time', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
	}

	public function down()
	{
		$this->dropColumn('tests_marks', 'time');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}