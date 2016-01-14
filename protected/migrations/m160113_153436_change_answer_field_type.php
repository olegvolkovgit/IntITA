<?php

class m160113_153436_change_answer_field_type extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('plain_task_answer', 'answer', 'TEXT NOT NULL');
		$this->alterColumn('tests_answers', 'answer', 'TEXT NOT NULL');
	}

	public function down()
	{
		echo "m160113_153436_change_answer_field_type does not support migration down.\n";
		return false;
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