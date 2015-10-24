<?php

class m151024_085328_add_translation_672 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '672',
				'category' => 'error',
				'message' => '0672'
			),
		));

		$this->insertMultiple('messages', array(
			array(
				'id_record' => null,
				'id' => '0672',
				'language' => 'ua',
				'translation' => 'Невірний формат файлу'
			),
			array(
				'id_record' => null,
				'id' => '0672',
				'language' => 'ru',
				'translation' => 'Неверный формат файла'
			),
			array(
				'id_record' => null,
				'id' => '0672',
				'language' => 'en',
				'translation' => 'Invalid file format'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('messages', 'id=672');
		$this->delete('sourcemessages', 'id=672');
	}
}