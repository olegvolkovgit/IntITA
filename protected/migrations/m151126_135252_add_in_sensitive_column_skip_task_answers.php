<?php

class m151126_135252_add_in_sensitive_column_skip_task_answers extends CDbMigration
{
	public function up()
	{
        $this->addColumn('skip_task_answers', 'case_in_sensitive',
            'TINYINT(1) NOT NULL DEFAULT "1" COMMENT "In default - 1 (no case sensitive), else - 0"');
	}

	public function down()
	{
		$this->dropColumn('skip_task_answers', 'case_in_sensitive');
	}
}