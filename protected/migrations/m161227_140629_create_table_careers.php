<?php

class m161227_140629_create_table_careers extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('careers', array(
			'id' => 'pk',
			'title_ua' => 'VARCHAR(30) NOT NULL',
			'title_ru' => 'VARCHAR(30) NOT NULL',
			'title_en' => 'VARCHAR(30) NOT NULL'
		));
		$this->insertMultiple('careers', array(
			array(
				'id' => 1,
				'title_en' => 'Freelance',
				'title_ru' => 'Фриланс',
				'title_ua' => 'Фріланс'
			),
			array(
				'id' => 2,
				'title_en' => 'Food company',
				'title_ru' => 'Продуктовая компания',
				'title_ua' => 'Продуктова компанія'
			),
			array(
				'id' => 3,
				'title_en' => 'Outsourcing',
				'title_ru' => 'Аутсорс',
				'title_ua' => 'Аутсорс'
			),
			array(
				'id' => 4,
				'title_en' => 'Own startup',
				'title_ru' => 'Собственный стартап',
				'title_ua' => 'Власний стартап'
			),
			array(
				'id' => 5,
				'title_en' => 'Training',
				'title_ru' => 'Стажировка',
				'title_ua' => 'Стажування'
			)
		));
	}

	public function safeDown()
	{
		$this->dropTable('careers');;
	}
}