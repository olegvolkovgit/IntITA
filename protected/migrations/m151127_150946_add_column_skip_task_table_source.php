<?php

class m151127_150946_add_column_skip_task_table_source extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('skip_task','source','TEXT NOT NULL COMMENT "Question source code for edit"');
	}

	public function safeDown()
	{
        $this->dropColumn('skip_task','source');
	}

}