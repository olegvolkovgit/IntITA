<?php

class m160216_114811_add_translations_796_799 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '796',
				'category' => 'editor',
				'message' => '0796'
			),
			array(
				'id' => '797',
				'category' => 'editor',
				'message' => '0797'
			),
			array(
				'id' => '798',
				'category' => 'editor',
				'message' => '0798'
			),
			array(
				'id' => '799',
				'category' => 'editor',
				'message' => '0799'
			)
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0796',
				'language' => 'ua',
				'translation' => 'Редагувати задачу з пропусками:'
			),
			array(
				'id_record' => null,
				'id' => '0796',
				'language' => 'ru',
				'translation' => 'Редактировать задачу с пропусками:'
			),
			array(
				'id_record' => null,
				'id' => '0796',
				'language' => 'en',
				'translation' => 'Edit task with gaps:'
			),
			array(
				'id_record' => null,
				'id' => '0797',
				'language' => 'ua',
				'translation' => 'Опис'
			),
			array(
				'id_record' => null,
				'id' => '0797',
				'language' => 'ru',
				'translation' => 'Описание'
			),
			array(
				'id_record' => null,
				'id' => '0797',
				'language' => 'en',
				'translation' => 'Description'
			),
            array(
                'id_record' => null,
                'id' => '0798',
                'language' => 'ua',
                'translation' => 'Запитання'
            ),
            array(
                'id_record' => null,
                'id' => '0798',
                'language' => 'ru',
                'translation' => 'Вопрос'
            ),
            array(
                'id_record' => null,
                'id' => '0798',
                'language' => 'en',
                'translation' => 'Question'
            ),
            array(
                'id_record' => null,
                'id' => '0799',
                'language' => 'ua',
                'translation' => 'Видалити задачу з пропусками'
            ),
            array(
                'id_record' => null,
                'id' => '0799',
                'language' => 'ru',
                'translation' => 'Удалить задачу с пропусками'
            ),
            array(
                'id_record' => null,
                'id' => '0799',
                'language' => 'en',
                'translation' => 'Delete task with gaps'
            )
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=796');
		$this->delete('sourcemessages', 'id=796');
		$this->delete('translate', 'id=797');
		$this->delete('sourcemessages', 'id=797');
		$this->delete('translate', 'id=798');
		$this->delete('sourcemessages', 'id=798');
		$this->delete('translate', 'id=799');
		$this->delete('sourcemessages', 'id=799');
	}
}