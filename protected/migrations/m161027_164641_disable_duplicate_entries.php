<?php

class m161027_164641_disable_duplicate_entries extends CDbMigration
{
	public function up()
	{
        $this->execute('UPDATE teacher set cancelled = 1 WHERE teacher.user_id  IN (SELECT th.user_id FROM (select `user_id`, count(*) as c from `teacher` group by `user_id`) as th WHERE th.c > 1)');
	}

	public function down()
	{
		echo "m161027_164641_disable_duplicate_entries does not support migration down.\n";
		return true;
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