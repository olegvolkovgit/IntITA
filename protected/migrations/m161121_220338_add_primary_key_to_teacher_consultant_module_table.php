<?php

class m161121_220338_add_primary_key_to_teacher_consultant_module_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn(
			'teacher_consultant_module',
			'id',
			'INT(10) AUTO_INCREMENT PRIMARY KEY'
		);
	}

	public function down()
	{
		$this->dropColumn('teacher_consultant_module', 'id');
	}
}