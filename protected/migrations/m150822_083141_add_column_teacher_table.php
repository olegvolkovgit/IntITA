<?php

class m150822_083141_add_column_teacher_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('teacher', 'isPrint', 'TINYINT(1) NOT NULL DEFAULT 1');
	}

	public function down()
	{
        $this->dropColumn('teacher', 'isPrint');
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