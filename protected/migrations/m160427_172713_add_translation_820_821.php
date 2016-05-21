<?php

class m160427_172713_add_translation_820_821 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '820',
				'category' => 'response',
				'message' => '0820'
			),
			array(
				'id' => '821',
				'category' => 'response',
				'message' => '0821'
			),
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0820',
				'language' => 'ua',
				'translation' => 'Відгук занадто короткий (мінімум {min} символів)'
			),
			array(
				'id_record' => null,
				'id' => '0820',
				'language' => 'ru',
				'translation' => 'Отзыв очень короткий (минимум {min} символов)'
			),
			array(
				'id_record' => null,
				'id' => '0820',
				'language' => 'en',
				'translation' => 'The response is too short (minimum is {min} characters)'
			),
			array(
				'id_record' => null,
				'id' => '0821',
				'language' => 'ua',
				'translation' => 'Відгук занадто довгий (максимум {max} символів)'
			),
			array(
				'id_record' => null,
				'id' => '0821',
				'language' => 'ru',
				'translation' => 'Отзыв очень длинный (максимум {max} символов)'
			),
			array(
				'id_record' => null,
				'id' => '0821',
				'language' => 'en',
				'translation' => 'The response is too long (maximum is {max} characters)'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=820');
		$this->delete('sourcemessages', 'id=820');
		$this->delete('translate', 'id=821');
		$this->delete('sourcemessages', 'id=821');
	}
}