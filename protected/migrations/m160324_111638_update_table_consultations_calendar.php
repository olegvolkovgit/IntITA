<?php

class m160324_111638_update_table_consultations_calendar extends CDbMigration
{
	public function safeUp()
	{
		$sqlConsultant = "update consultations_calendar cc set teacher_id = (select user_id from teacher t where t.teacher_id=cc.teacher_id);";
		$this->execute($sqlConsultant);
	}


	public function down()
	{
		echo "m160324_111638_update_table_consultations_calendar does not support migration down.\n";
		return false;
	}
}