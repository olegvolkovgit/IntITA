<?php

class m150815_075731_add_page_title_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('lecture_page', 'page_title', 'VARCHAR(255) NULL DEFAULT NULL');
	}

	public function down()
	{
        $this->dropColumn('lecture_page', 'page_title');
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