<?php

class m150914_140851_add_column_mandatory_modules extends CDbMigration
{
	public function up()
	{
        $this->addColumn('course_modules', 'mandatory_modules', 'INT(10) NULL DEFAULT NULL');
	}

	public function down()
    {
        $this->dropColumn('course_modules', 'mandatory_modules');
	}

}