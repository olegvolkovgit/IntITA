<?php

class m160427_131548_add_translation_for_course_page extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '819',
				'category' => 'course',
				'message' => '0819'
			),
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0819',
				'language' => 'ua',
				'translation' => 'Ціна за весь курс наперед (розгорнути схеми офлайн)'
			),
			array(
				'id_record' => null,
				'id' => '0819',
				'language' => 'ru',
				'translation' => 'Цена за весь курс наперед (схемы проплат оффлайн)'
			),
			array(
				'id_record' => null,
				'id' => '0819',
				'language' => 'en',
				'translation' => 'Show the payment plan (offline payment scheme)'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=819');
		$this->delete('sourcemessages', 'id=819');
	}
}