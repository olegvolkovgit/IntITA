<?php

class m160430_053705_create_vc_skip_task_answers_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('vc_skip_task_answers', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'id_task' => 'INT(10) NOT NULL', //id_lecture_element
            'answer' => 'VARCHAR(255) NOT NULL',   //id_lecture_element
            'answer_order' => 'INT(11) NOT NULL',
            'case_in_sensitive' => 'TINYINT(1) DEFAULT NULL',
            'CONSTRAINT `FK_vc_skip_task_answer_skip_task` FOREIGN KEY (`id_task`) REFERENCES `vc_skip_task` (`id`)',
        ]);
	}

	public function down()
	{
        $this->dropTable('vc_skip_task_answers');
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