<?php

class m171120_190010_add_students_project_table extends CDbMigration
{

	public function safeUp()
	{
	 $this->createTable('students_projects', [
            'id' => 'INT(10) PRIMARY KEY AUTO_INCREMENT',
            'id_student' => 'INT(11) NOT NULL',
            'title' => 'VARCHAR(255) NOT NULL',
            'repository' => 'VARCHAR(255) NOT NULL',
            'branch' => 'VARCHAR(255) NOT NULL',
            'need_check' => 'INT(11) DEFAULT 1',
        ]);

        $this->addForeignKey('FK_student_relation','students_projects','id_student','user','id', 'CASCADE', 'CASCADE');

	}

	public function safeDown()
	{
	echo "m171120_190010_add_students_project_table does not support migration down.\n";
	$this->dropForeignKey('FK_student_relation','students_projects');
	$this->dropTable('students_projects');
		return true;
	}

}