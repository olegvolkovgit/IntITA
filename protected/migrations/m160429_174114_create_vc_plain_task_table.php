<?php

class m160429_174114_create_vc_plain_task_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('vc_plain_task', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'id_lecture_element' => 'INT(10) NOT NULL',
            'id_test' => 'INT DEFAULT NULL',
            'CONSTRAINT `FK_vc_plain_task_vc_lecture_element` FOREIGN KEY (`id_lecture_element`) REFERENCES `vc_lecture_element` (`id`)',
        ]);
	}

	public function down()
	{
        $this->dropTable('vc_plain_task');
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