<?php

class m150829_070223_add_column_element_order extends CDbMigration
{
	public function up()
	{
        $this->addColumn('lecture_element_lecture_page', 'element_order', 'INT(10) NOT NULL');
	}

	public function down()
	{
        $this->dropColumn('lecture_element_lecture_page', 'element_order');
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