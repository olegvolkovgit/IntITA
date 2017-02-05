<?php

class m161227_173716_create_education_shift_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('education_shift', array(
			'id' => 'pk',
			'title_ua' => 'VARCHAR(30) NOT NULL',
			'title_ru' => 'VARCHAR(30) NOT NULL',
			'title_en' => 'VARCHAR(30) NOT NULL'
		));

		$this->insertMultiple('education_shift', array(
			array(
				'id' => 1,
				'title_en' => 'morning',
				'title_ru' => 'утренняя',
				'title_ua' => 'ранкова'
			),
			array(
				'id' => 2,
				'title_en' => 'evening',
				'title_ru' => 'вечерняя',
				'title_ua' => 'вечірня'
			),
			array(
				'id' => 3,
				'title_en' => 'all one',
				'title_ru' => 'без разницы',
				'title_ua' => 'байдуже'
			),
		));
	}

	public function safeDown()
	{
		$this->dropTable('education_shift');
	}
}