<?php

class m150714_145405_create_task_marks_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('task_marks', array(
            'id' => 'pk',
            'id_user' => 'INT(10) NOT NULL',
            'id_task' => 'INT(10) NOT NULL',
            'mark' => 'TINYINT(1) NOT NULL',
            'comment' => 'VARCHAR(100) NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('task_marks');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}