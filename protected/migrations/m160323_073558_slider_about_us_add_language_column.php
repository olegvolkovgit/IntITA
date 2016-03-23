<?php

class m160323_073558_slider_about_us_add_language_column extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('aboutus_slider','text_ua','text NOT NULL');
		$this->addColumn('aboutus_slider','text_ru','text NOT NULL');
		$this->addColumn('aboutus_slider','text_en','text NOT NULL');

		$this->dropColumn('aboutus_slider','text');
	}

	public function safeDown()
	{
		$this->dropColumn('aboutus_slider','text_ua');
		$this->dropColumn('aboutus_slider','text_ru');
		$this->dropColumn('aboutus_slider','text_en');

		$this->addColumn('aboutus_slider','text','text NOT NULL');
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