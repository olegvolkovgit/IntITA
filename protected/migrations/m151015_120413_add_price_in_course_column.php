<?php

class m151015_120413_add_price_in_course_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('course_modules', 'price_in_course', 'INT(10) NULL DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('course_modules', 'price_in_course');
	}
}