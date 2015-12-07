<?php

class m151201_132542_add_column_plain_task_answer extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('plain_task_answer','consultant','INT(10) DEFAULT NULL');
	}

	public function safeDown()
	{
        $this->dropColumn('plain_task_answer','consultant');
	}

}