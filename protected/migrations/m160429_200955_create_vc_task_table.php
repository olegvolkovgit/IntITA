<?php

class m160429_200955_create_vc_task_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('vc_task', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'language' => 'VARCHAR(12) DEFAULT NULL',
            'assignment' => 'INT(10) DEFAULT NULL',
            'id_lecture_element' => 'INT(11) NOT NULL', //condition
            'table' => 'VARCHAR(20) DEFAULT NULL',
            'id_test' => 'INT DEFAULT NULL',
            'CONSTRAINT `FK_vc_task_vc_lecture_element` FOREIGN KEY (`id_lecture_element`) REFERENCES `vc_lecture_element` (`id`)',
        ]);
	}

	public function down()
	{
        $this->dropTable('vc_task');
		return false;
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