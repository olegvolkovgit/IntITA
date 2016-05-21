<?php

class m160517_185132_alter_vc_quiz_tables extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('vc_plain_task', 'uid', 'INT(10) NOT NULL');

        $this->alterColumn('vc_skip_task', 'uid', 'INT(10) NOT NULL');
        $this->alterColumn('vc_skip_task_answers', 'quiz_uid', 'INT(10) NOT NULL');

        $this->alterColumn('vc_task', 'uid', 'INT(10) NOT NULL');

        $this->alterColumn('vc_tests', 'uid', 'INT(10) NOT NULL');
        $this->alterColumn('vc_tests_answers', 'quiz_uid', 'INT(10) NOT NULL');
	}

	public function down()
	{
        $this->alterColumn('vc_plain_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');

        $this->alterColumn('vc_skip_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->alterColumn('vc_skip_task_answers', 'quiz_uid', 'INT(10) DEFAULT NULL');

        $this->alterColumn('vc_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');

        $this->alterColumn('vc_tests', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->alterColumn('vc_tests_answers', 'quiz_uid', 'INT(10) DEFAULT NULL');
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