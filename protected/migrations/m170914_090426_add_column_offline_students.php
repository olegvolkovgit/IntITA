<?php

class m170914_090426_add_column_offline_students extends CDbMigration
{
	public function up()
	{
        $this->addColumn('offline_students', 'end_study_leave', 'DATE NULL DEFAULT NULL');
        $this->addColumn('offline_students', 'comment', 'VARCHAR(255) NULL DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('offline_students', 'end_study_leave');
		$this->dropColumn('offline_students', 'comment');
	}
}