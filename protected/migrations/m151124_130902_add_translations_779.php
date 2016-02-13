<?php

class m151124_130902_add_translations_779 extends CDbMigration
{

	public function safeUp()
	{
        $this->insertMultiple('sourcemessages', array(
        array(
            'id' => '779',
            'category' => 'user',
            'message' => '0779'
        )));

        $this->insertMultiple('messages', array(
            array(
                'id_record' => null,
                'id' => '0779',
                'language' => 'ua',
                'translation' => 'Соціальні мережі'
            ),
            array(
                'id_record' => null,
                'id' => '0779',
                'language' => 'ru',
                'translation' => 'Социальные сети'
            ),
            array(
                'id_record' => null,
                'id' => '0779',
                'language' => 'en',
                'translation' => 'Social network'
            )
        ));
	}

	public function safeDown()
	{
        $this->delete('messages', 'id=779');
        $this->delete('sourcemessages', 'id=779');
	}
}