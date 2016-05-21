<?php

class m160421_155854_change_teacher_id_in_teacher_module_table extends CDbMigration
{
	public function up()
	{
		$sql = 'update teacher_module set idTeacher = (select user_id from teacher where teacher_id=idTeacher)';
		$this->execute($sql);
	}

	public function down()
	{
		echo "m160421_155854_change_teacher_id_in_teacher_module_table does not support migration down.\n";
		return false;
	}
}