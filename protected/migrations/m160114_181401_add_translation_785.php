<?php

class m160114_181401_add_translation_785 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '785',
				'category' => 'breadcrumbs',
				'message' => '0785'
			)
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0785',
				'language' => 'ua',
				'translation' => 'Видалено.'
			),
			array(
				'id_record' => null,
				'id' => '0785',
				'language' => 'ru',
				'translation' => 'Удалено.'
			),
			array(
				'id_record' => null,
				'id' => '0785',
				'language' => 'en',
				'translation' => 'Gone.'
			)
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=785');
		$this->delete('sourcemessages', 'id=785');
	}
}