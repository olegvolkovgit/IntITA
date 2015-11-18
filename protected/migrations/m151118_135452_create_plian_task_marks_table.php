<?php

class m151118_135452_create_plian_task_marks_table extends CDbMigration
{
//	public function up()
//	{
//
//	}
//
//	public function down()
//	{
//
//	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{$this->createTable('plain_task_marks', array(
            'id' => 'pk',
            'id_user' => 'INT(10) NOT NULL',
            'id_task' => 'INT(10) NOT NULL',
            'mark' => 'TINYINT NOT NULL',
            'comment' => 'VARCHAR(100)',
            'time' => 'TIMESTAMP'
        ));
	}

	public function safeDown()
	{
	$this->dropTable('plain_task_marks');
	}

}