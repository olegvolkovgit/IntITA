<?php

class m150920_212642_add_course_number_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('course', 'course_number', 'INT(10) NULL DEFAULT NULL');
	}

	public function down()
	{
        $this->dropColumn('course', 'course_number');
	}
}