<?php

class m151112_135049_create_plain_task_answer extends CDbMigration
{
	public function up()
	{
        $this->createTable('plain_task_answer', array(
            'id' => 'pk',
            'answer' => 'VARCHAR(255) NULL DEFAULT NULL',
            'id_student' => 'INT NOT NULL',
            'id_plain_task' => 'INT NOT NULL',
            'date' => 'TIMESTAMP'

        ));
	}

	public function down()
	{
        $this->dropTable('plain_task_answer');
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