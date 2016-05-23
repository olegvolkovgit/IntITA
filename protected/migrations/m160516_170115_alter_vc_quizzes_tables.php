<?php

class m160516_170115_alter_vc_quizzes_tables extends CDbMigration
{
	public function up()
	{


  
        $this->dropIndex('uid', 'vc_skip_task');
        $this->dropIndex('uid', 'vc_task');
        $this->dropIndex('uid', 'vc_tests');
        
	}

	public function down()
	{
        $this->alterColumn('vc_plain_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');

        $this->alterColumn('vc_skip_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->alterColumn('vc_skip_task_answers', 'quiz_uid', 'INT(10) DEFAULT NULL');

        $this->alterColumn('vc_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');

        $this->alterColumn('vc_tests', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->alterColumn('vc_tests_answers', 'quiz_uid', 'INT(10) DEFAULT NULL');

        $this->dropColumn('vc_plain_task', 'updated');
        $this->dropColumn('vc_skip_task', 'updated');
        $this->dropColumn('vc_task', 'updated');
        $this->dropColumn('vc_tests', 'updated');

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