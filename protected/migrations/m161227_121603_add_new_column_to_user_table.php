<?php

class m161227_121603_add_new_column_to_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('user', 'prev_job', 'TEXT NULL DEFAULT NULL');
		$this->addColumn('user', 'current_job', 'TEXT NULL DEFAULT NULL');
		$this->addColumn('user', 'education_shift', 'INT(10) NULL DEFAULT NULL');
		$this->alterColumn('user','document_issued_date','DATE DEFAULT NULL');
	}

	public function safeDown()
	{
		$this->dropColumn('user', 'prev_job');
		$this->dropColumn('user', 'current_job');
		$this->dropColumn('user', 'education_shift');
	}
}