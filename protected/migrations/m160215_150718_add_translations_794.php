<?php

class m160215_150718_add_translations_794 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '794',
				'category' => 'teacher',
				'message' => '0794'
			),
			array(
				'id' => '795',
				'category' => 'teacher',
				'message' => '0795'
			)
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0794',
				'language' => 'ua',
				'translation' => 'Розпочати бесіду'
			),
			array(
				'id_record' => null,
				'id' => '0794',
				'language' => 'ru',
				'translation' => 'Начать разговор'
			),
			array(
				'id_record' => null,
				'id' => '0794',
				'language' => 'en',
				'translation' => 'Start dialog'
			),
			array(
				'id_record' => null,
				'id' => '0795',
				'language' => 'ua',
				'translation' => 'Приватне повідомлення'
			),
			array(
				'id_record' => null,
				'id' => '0795',
				'language' => 'ru',
				'translation' => 'Личное сообщение'
			),
			array(
				'id_record' => null,
				'id' => '0795',
				'language' => 'en',
				'translation' => 'Private message'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=794');
		$this->delete('sourcemessages', 'id=794');
		$this->delete('translate', 'id=795');
		$this->delete('sourcemessages', 'id=795');
	}
}