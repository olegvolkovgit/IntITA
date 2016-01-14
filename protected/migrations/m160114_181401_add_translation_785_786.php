<?php

class m160114_181401_add_translation_785_786 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '785',
				'category' => 'breadcrumbs',
				'message' => '0785'
			),
            array(
                'id' => '786',
                'category' => 'error',
                'message' => '0786'
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
			),
            array(
                'id_record' => null,
                'id' => '0786',
                'language' => 'ua',
                'translation' => 'Доступ до даного курсу закритий.'
            ),
            array(
                'id_record' => null,
                'id' => '0786',
                'language' => 'ru',
                'translation' => 'Доступ к этому курсу закрыт.'
            ),
            array(
                'id_record' => null,
                'id' => '0786',
                'language' => 'en',
                'translation' => 'Access to this course closed.'
            )
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=785');
		$this->delete('sourcemessages', 'id=785');
        $this->delete('translate', 'id=786');
        $this->delete('sourcemessages', 'id=786');
	}
}