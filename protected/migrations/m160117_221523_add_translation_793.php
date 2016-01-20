<?php

class m160117_221523_add_translation_793 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '793',
				'category' => 'lesson',
				'message' => '0793'
			)
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0793',
				'language' => 'ua',
				'translation' => 'Ваша відповідь буде оброблена в найближчий час.'
			),
			array(
				'id_record' => null,
				'id' => '0793',
				'language' => 'ru',
				'translation' => 'Ваш ответ будет обработан в ближайшее время.'
			),
			array(
				'id_record' => null,
				'id' => '0793',
				'language' => 'en',
				'translation' => 'Your answer will be processed in the near future.'
			)
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=793');
		$this->delete('sourcemessages', 'id=793');
	}
}