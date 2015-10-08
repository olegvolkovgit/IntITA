<?php

class m150924_140424_add_lecture_translation extends CDbMigration
{
	public function up()
	{
        $this->insert('sourcemessages', array(
            'id' => '617',
            'category' => 'lecture',
            'message' => '0617'
        ));

        $this->insertMultiple('messages', array(
            array(
                'id_record' => null,
                'id' => '0617',
                'language' => 'ua',
                'translation' => 'Форум'
            ),
            array(
                'id_record' => null,
                'id' => '0617',
                'language' => 'ru',
                'translation' => 'Форум'
            ),
            array(
                'id_record' => null,
                'id' => '0617',
                'language' => 'en',
                'translation' => 'Forum'
            ),
        ));
	}

	public function down()
	{
        $this->delete('messages', 'id=617');
        $this->delete('sourcemessages', 'id=617');
	}
}