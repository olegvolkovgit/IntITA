<?php

class m160401_130122_update_teacher_id_in_leader_modules_table extends CDbMigration
{
	public function safeUp()
	{
		$sql = "update leader_modules set leader = (select user_id from teacher where teacher_id=leader);";
		$this->dropForeignKey('FK_leader_modules_teacher', 'leader_modules');
		$this->execute($sql);
	}

	public function down()
	{
		echo "m160401_130122_update_teacher_id_in_leader_modules_table does not support migration down.\n";
		return false;
	}
}