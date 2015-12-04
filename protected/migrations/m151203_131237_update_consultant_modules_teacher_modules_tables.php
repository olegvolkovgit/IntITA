<?php

class m151203_131237_update_consultant_modules_teacher_modules_tables extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('teacher_module', 'start_time', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('teacher_module', 'end_time', 'DATETIME NULL DEFAULT NULL');

        $this->addColumn('consultant_modules', 'start_time', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('consultant_modules', 'end_time', 'DATETIME NULL DEFAULT NULL');
	}

	public function safeDown()
	{
        $this->dropColumn('teacher_module' , 'start_time');
        $this->dropColumn('teacher_module', 'end_time');

        $this->dropColumn('consultant_modules' , 'start_time');
        $this->dropColumn('consultant_modules', 'end_time');
	}
}