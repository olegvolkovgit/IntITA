<?php

class m160323_153848_main_slider_add_language_columns extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('carousel','text_ua','text NOT NULL');
		$this->addColumn('carousel','text_ru','text NOT NULL');
		$this->addColumn('carousel','text_en','text NOT NULL');

		$this->dropColumn('carousel','slider_text');
	}

	public function safeDown()
	{
		$this->dropColumn('carousel','text_ua');
		$this->dropColumn('carousel','text_ru');
		$this->dropColumn('carousel','text_en');

		$this->addColumn('carousel','slider_text','text NOT NULL');
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