<?php

class m170320_105708_add_offline_status_to_course_table extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('course', 'status_offline', 'TINYINT(4) NOT NULL DEFAULT 0');
        $this->renameColumn ('course', 'status', 'status_online');
	}

	public function safeDown()
	{
        $this->dropColumn('course', 'status_offline');
        $this->renameColumn ('course', 'status_online', 'status');
	}
}