<?php

class m160401_124210_create_table_teacher_consultant_module extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('teacher_consultant_module', array(
			'id_teacher' => 'INT(10) NOT NULL',
			'id_module' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
            'INDEX `FK_teacher_consultant_module_user` (`id_teacher`)',
            'INDEX `FK_teacher_consultant_module_module` (`id_module`)',
            'CONSTRAINT `FK_teacher_consultant_module_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`module_ID`)',
            'CONSTRAINT `FK_teacher_consultant_module_user` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`)'
		), 'COLLATE=\'utf8_general_ci\' ENGINE=InnoDB');
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_teacher_consultant_module_module', 'teacher_consultant_module');
        $this->dropForeignKey('FK_teacher_consultant_module_user', 'teacher_consultant_module');
        $this->dropTable('teacher_consultant_module');
	}
}