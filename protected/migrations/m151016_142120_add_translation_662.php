<?php

class m151016_142120_add_translation_662 extends CDbMigration
{
	public function safeUp()
	{
        $this->insertMultiple('sourcemessages', array(
            array(
                'id' => '662',
                'category' => 'course',
                'message' => '0662'
            ),
        ));

        $this->insertMultiple('messages', array(
            array(
                'id_record' => null,
                'id' => '0662',
                'language' => 'ua',
                'translation' => 'Схема курса'
            ),
            array(
                'id_record' => null,
                'id' => '0662',
                'language' => 'ru',
                'translation' => 'Схема курса'
            ),
            array(
                'id_record' => null,
                'id' => '0662',
                'language' => 'en',
                'translation' => 'Course schema'
            ),
            ));
	}

	public function safeDown()
	{
        $this->delete('messages', 'id=662');
        $this->delete('sourcemessages', 'id=662');
	}
}