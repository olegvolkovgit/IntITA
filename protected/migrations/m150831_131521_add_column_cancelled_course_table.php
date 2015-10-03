<?php

class m150831_131521_add_column_cancelled_course_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('course', 'cancelled', 'TINYINT(1) NOT NULL DEFAULT 0');
	}

	public function down()
	{
        $this->dropColumn('course', 'cancelled');
	}

}