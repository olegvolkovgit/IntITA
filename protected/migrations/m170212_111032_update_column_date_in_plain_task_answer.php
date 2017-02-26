<?php

class m170212_111032_update_column_date_in_plain_task_answer extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('plain_task_answer', 'date', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
	}

	public function down()
	{
		$this->alterColumn('plain_task_answer', 'date', 'TIMESTAMP');
	}
}