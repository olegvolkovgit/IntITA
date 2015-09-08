<?php

class m150908_115912_add_translations_for_error_page extends CDbMigration
{
	public function up()
	{
        $this->insert('sourcemessages', array(
           'id' => '590',
            'category' => 'error',
            'message' => '0590'
        ));
        $this->insert('sourcemessages', array(
            'id' => '591',
            'category' => 'registration',
            'message' => '0591'
        ));
        $this->insertMultiple('messages', array(
            array(
                'id_record' => null,
                'id' => '0590',
                'language' => 'ua',
                'translation' => 'Помилка'
            ),
            array(
                'id_record' => null,
                'id' => '0590',
                'language' => 'ru',
                'translation' => 'Ошибка'
            ),
            array(
                'id_record' => null,
                'id' => '0590',
                'language' => 'en',
                'translation' => 'Error'
            ),
            array(
                'id_record' => null,
                'id' => '0591',
                'language' => 'ua',
                'translation' => 'Зареєструватися'
            ),
            array(
                'id_record' => null,
                'id' => '0591',
                'language' => 'ru',
                'translation' => 'Зарегистрироваться'
            ),
            array(
                'id_record' => null,
                'id' => '0591',
                'language' => 'en',
                'translation' => 'Sign up'
            ),

        ));

	}

	public function down()
	{
        $this->delete('messages', 'id=590');
        $this->delete('messages', 'id=591');
        $this->delete('sourcemessages', 'id=590');
        $this->delete('sourcemessages', 'id=591');
	}
}