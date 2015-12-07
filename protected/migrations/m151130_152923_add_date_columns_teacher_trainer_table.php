<?php

class m151130_152923_add_date_columns_teacher_trainer_table extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('trainer_student', 'start_time', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('trainer_student', 'end_time', 'DATETIME NULL DEFAULT NULL');
	}

	public function safeDown()
	{
		$this->dropColumn('trainer_student', 'start_time');
        $this->dropColumn('trainer_student', 'end_time');
	}
}