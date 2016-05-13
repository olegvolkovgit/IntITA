<?php

class m160513_085902_add_column_cancelled_teacher_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('teacher', 'cancelled', 'TINYINT(1) NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->dropColumn('teacher', 'cancelled');
	}
}