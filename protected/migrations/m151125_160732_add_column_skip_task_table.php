<?php

class m151125_160732_add_column_skip_task_table extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m151125_160732_add_column_skip_task_table does not support migration down.\n";
//		return false;
//	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('skip_task','question','INT(10) NOT NULL');
        $this->addForeignKey('FK_skip_task_question_lecture_element','skip_task','question','lecture_element','id_block');
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_skip_task_question_lecture_element','skip_task');
        $this->dropColumn('skip_task','question');

	}

}