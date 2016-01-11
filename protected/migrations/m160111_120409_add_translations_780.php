<?php

class m160111_120409_add_translations_780 extends CDbMigration
{

	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '780',
				'category' => 'course_schema',
				'message' => '0780'
			)
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0780',
				'language' => 'ua',
				'translation' => 'Схема для даного курса ще не створена.'
			),
			array(
				'id_record' => null,
				'id' => '0780',
				'language' => 'ru',
				'translation' => 'Схема для даного курса еще не создана.'
			),
			array(
				'id_record' => null,
				'id' => '0780',
				'language' => 'en',
				'translation' => 'Scheme for this course is not yet established.'
			)
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=780');
		$this->delete('sourcemessages', 'id=780');
	}
}