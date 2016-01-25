<?php

class m160115_102320_add_translations_787_792 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '787',
				'category' => 'editor',
				'message' => '0787'
			),
			array(
				'id' => '788',
				'category' => 'editor',
				'message' => '0788'
			),
            array(
                'id' => '789',
                'category' => 'editor',
                'message' => '0789'
            ),
            array(
                'id' => '790',
                'category' => 'editor',
                'message' => '0790'
            ),
            array(
                'id' => '791',
                'category' => 'editor',
                'message' => '0791'
            ),
            array(
                'id' => '792',
                'category' => 'consultations',
                'message' => '0792'
            )
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0787',
				'language' => 'ua',
				'translation' => 'Додати завдання'
			),
			array(
				'id_record' => null,
				'id' => '0787',
				'language' => 'ru',
				'translation' => 'Добавить задание'
			),
			array(
				'id_record' => null,
				'id' => '0787',
				'language' => 'en',
				'translation' => 'Add task'
			),
			array(
				'id_record' => null,
				'id' => '0788',
				'language' => 'ua',
				'translation' => 'Додати нову задачу з пропусками:'
			),
			array(
				'id_record' => null,
				'id' => '0788',
				'language' => 'ru',
				'translation' => 'Добавить новую задачу с пропусками:'
			),
			array(
				'id_record' => null,
				'id' => '0788',
				'language' => 'en',
				'translation' => 'Add new task with skip answers:'
			),
            array(
                'id_record' => null,
                'id' => '0789',
                'language' => 'ua',
                'translation' => 'Додати задачу з пропусками'
            ),
            array(
                'id_record' => null,
                'id' => '0789',
                'language' => 'ru',
                'translation' => 'Добавить задачу с пропусками'
            ),
            array(
                'id_record' => null,
                'id' => '0789',
                'language' => 'en',
                'translation' => 'Add task with skip answers'
            ),
            array(
                'id_record' => null,
                'id' => '0790',
                'language' => 'ua',
                'translation' => 'Умова:'
            ),
            array(
                'id_record' => null,
                'id' => '0790',
                'language' => 'ru',
                'translation' => 'Условие:'
            ),
            array(
                'id_record' => null,
                'id' => '0790',
                'language' => 'en',
                'translation' => 'Condition:'
            ),
            array(
                'id_record' => null,
                'id' => '0791',
                'language' => 'ua',
                'translation' => 'Текст з відповідями:'
            ),
            array(
                'id_record' => null,
                'id' => '0791',
                'language' => 'ru',
                'translation' => 'Текст с ответами:'
            ),
            array(
                'id_record' => null,
                'id' => '0791',
                'language' => 'en',
                'translation' => 'Text with answers:'
            ),
            array(
                'id_record' => null,
                'id' => '0792',
                'language' => 'ua',
                'translation' => 'Консультантів з питань цього модуля ще немає.'
            ),
            array(
                'id_record' => null,
                'id' => '0792',
                'language' => 'ru',
                'translation' => 'Консультантов по вопросам этого модуля еще нет.'
            ),
            array(
                'id_record' => null,
                'id' => '0792',
                'language' => 'en',
                'translation' => 'There aren\'t consultants for this module.'
            )
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=787');
		$this->delete('sourcemessages', 'id=787');
		$this->delete('translate', 'id=788');
		$this->delete('sourcemessages', 'id=788');
        $this->delete('translate', 'id=789');
        $this->delete('sourcemessages', 'id=789');
        $this->delete('translate', 'id=790');
        $this->delete('sourcemessages', 'id=790');
        $this->delete('translate', 'id=791');
        $this->delete('sourcemessages', 'id=791');
        $this->delete('translate', 'id=792');
        $this->delete('sourcemessages', 'id=792');
	}
}