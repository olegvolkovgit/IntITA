<?php

class m160624_102936_add_cancelled_user_and_date_consultations extends CDbMigration
{

	public function safeUp()
	{
		$this->addColumn('consultations_calendar', 'date_cancelled', 'DATETIME DEFAULT NULL');
        $this->addColumn('consultations_calendar', 'user_cancelled', 'INT(11) DEFAULT NULL');
        $this->addForeignKey('FK_consultations_calendar_user', 'consultations_calendar', 'user_cancelled', 'user', 'id');
	}

	public function safeDown()
	{
        $this->dropColumn('consultations_calendar', 'date_cancelled');
        $this->dropColumn('consultations_calendar', 'user_cancelled');
        $this->dropForeignKey('FK_consultations_calendar_user', 'consultations_calendar');
	}

}