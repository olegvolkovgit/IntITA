<?php

class m151021_083705_add_translation_664 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '664',
				'category' => 'course',
				'message' => '0664'
			),
		));

		$this->insertMultiple('messages', array(
			array(
				'id_record' => null,
				'id' => '0664',
				'language' => 'ua',
				'translation' => 'міс.'
			),
			array(
				'id_record' => null,
				'id' => '0664',
				'language' => 'ru',
				'translation' => 'мес.'
			),
			array(
				'id_record' => null,
				'id' => '0664',
				'language' => 'en',
				'translation' => 'months'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('messages', 'id=664');
		$this->delete('sourcemessages', 'id=664');
		$this->delete('messages', 'id=664');
		$this->delete('sourcemessages', 'id=664');
	}
}