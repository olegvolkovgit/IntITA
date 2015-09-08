<?php

class m150908_115822_add_column_slider_text_carousel_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('carousel', 'slider_text', 'VARCHAR(6) NOT NULL');

	}

	public function down()
	{
        $this->dropColumn('carousel', 'slider_text');
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