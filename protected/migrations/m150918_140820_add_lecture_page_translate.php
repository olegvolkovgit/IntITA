<?php

class m150918_140820_add_lecture_page_translate extends CDbMigration
{
	public function up()
	{
//        $this->insert('sourcemessages', array(
//            'id' => '613',
//            'category' => 'lecture',
//            'message' => '0613'
//        ));
//        $this->insert('sourcemessages', array(
//            'id' => '614',
//            'category' => 'lecture',
//            'message' => '0614'
//        ));
        $this->insert('sourcemessages', array(
            'id' => '615',
            'category' => 'lecture',
            'message' => '0615'
        ));
        $this->insertMultiple('messages', array(
            array(
                'id_record' => null,
                'id' => '0613',
                'language' => 'ua',
                'translation' => 'Відео'
            ),
            array(
                'id_record' => null,
                'id' => '0613',
                'language' => 'ru',
                'translation' => 'Видео'
            ),
            array(
                'id_record' => null,
                'id' => '0613',
                'language' => 'en',
                'translation' => 'Video'
            ),
            array(
                'id_record' => null,
                'id' => '0614',
                'language' => 'ua',
                'translation' => 'Текст'
            ),
            array(
                'id_record' => null,
                'id' => '0614',
                'language' => 'ru',
                'translation' => 'Текст'
            ),
            array(
                'id_record' => null,
                'id' => '0614',
                'language' => 'en',
                'translation' => 'Text'
            ),
            array(
                'id_record' => null,
                'id' => '0615',
                'language' => 'ua',
                'translation' => 'Частина'
            ),
            array(
                'id_record' => null,
                'id' => '0615',
                'language' => 'ru',
                'translation' => 'Часть'
            ),
            array(
                'id_record' => null,
                'id' => '0615',
                'language' => 'en',
                'translation' => 'Part'
            ),

        ));
	}

	public function down()
	{
        $this->delete('messages', 'id=613');
        $this->delete('messages', 'id=614');
        $this->delete('messages', 'id=615');
        $this->delete('sourcemessages', 'id=613');
        $this->delete('sourcemessages', 'id=614');
        $this->delete('sourcemessages', 'id=615');
	}
}