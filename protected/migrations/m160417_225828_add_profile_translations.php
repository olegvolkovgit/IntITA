<?php

class m160417_225828_add_profile_translations extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '817',
				'category' => 'regexp',
				'message' => '0817'
			),
			array(
				'id' => '818',
				'category' => 'regexp',
				'message' => '0818'
			)
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0817',
				'language' => 'ua',
				'translation' => 'Країна'
			),
			array(
				'id_record' => null,
				'id' => '0817',
				'language' => 'ru',
				'translation' => 'Страна'
			),
			array(
				'id_record' => null,
				'id' => '0817',
				'language' => 'en',
				'translation' => 'Country'
			),
			array(
				'id_record' => null,
				'id' => '0818',
				'language' => 'ua',
				'translation' => 'Місто'
			),
			array(
				'id_record' => null,
				'id' => '0818',
				'language' => 'ru',
				'translation' => 'Город'
			),
			array(
				'id_record' => null,
				'id' => '0818',
				'language' => 'en',
				'translation' => 'City'
			)
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=817');
		$this->delete('sourcemessages', 'id=817');
		$this->delete('translate', 'id=818');
		$this->delete('sourcemessages', 'id=818');
	}
}