<?php

class m150923_125621_add_lecture_page_translation extends CDbMigration
{
	public function up()
	{
        $this->insert('sourcemessages', array(
            'id' => '616',
            'category' => 'lecture',
            'message' => '0616'
        ));

        $this->insertMultiple('messages', array(
            array(
                'id_record' => null,
                'id' => '0616',
                'language' => 'ua',
                'translation' => 'занять'
            ),
            array(
                'id_record' => null,
                'id' => '0616',
                'language' => 'ru',
                'translation' => 'занятий'
            ),
            array(
                'id_record' => null,
                'id' => '0616',
                'language' => 'en',
                'translation' => 'lectures'
            ),
          ));

    }

	public function down()
	{
        $this->delete('messages', 'id=616');
        $this->delete('sourcemessages', 'id=616');
	}
}