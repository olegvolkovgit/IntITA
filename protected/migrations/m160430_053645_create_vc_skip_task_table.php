<?php

class m160430_053645_create_vc_skip_task_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('vc_skip_task', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'condition' => 'INT(10) NOT NULL', //id_lecture_element
            'question' => 'TEXT NOT NULL',   //id_lecture_element
            'source' => 'TEXT NOT NULL',
            'id_test' => 'INT DEFAULT NULL',
            'CONSTRAINT `FK_vc_skip_task_condition_vc_lecture_element` FOREIGN KEY (`condition`) REFERENCES `vc_lecture_element` (`id`)',
        ]);
	}

	public function down()
	{
        $this->dropTable('vc_skip_task');
		return true;
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