<?php

class m151014_105911_add_translations_656_658 extends CDbMigration
{
	public function up()
	{
		$this->insertMultiple('sourcemessages', array(
            array(
			    'id' => '656',
			    'category' => 'payment',
			    'message' => '0656'
		    ),
            array(
                'id' => '657',
                'category' => 'payment',
                'message' => '0657'
            ),
            array(
               'id' => '658',
               'category' => 'payment',
               'message' => '0658'
            ),
            array(
                'id' => '659',
                'category' => 'lecture',
                'message' => '0659'
            ),
        ));

		$this->insertMultiple('messages', array(
			array(
				'id_record' => null,
				'id' => '0656',
				'language' => 'ua',
				'translation' => 'Модуль'
			),
			array(
				'id_record' => null,
				'id' => '0656',
				'language' => 'ru',
				'translation' => 'Модуль'
			),
			array(
				'id_record' => null,
				'id' => '0656',
				'language' => 'en',
				'translation' => 'Module'
			),
            array(
                'id_record' => null,
                'id' => '0657',
                'language' => 'ua',
                'translation' => 'Курс'
            ),
            array(
                'id_record' => null,
                'id' => '0657',
                'language' => 'ru',
                'translation' => 'Курс'
            ),
            array(
                'id_record' => null,
                'id' => '0657',
                'language' => 'en',
                'translation' => 'Course'
            ),
            array(
                'id_record' => null,
                'id' => '0658',
                'language' => 'ua',
                'translation' => 'Надрукувати'
            ),
            array(
                'id_record' => null,
                'id' => '0658',
                'language' => 'ru',
                'translation' => 'Напечатать'
            ),
            array(
                'id_record' => null,
                'id' => '0658',
                'language' => 'en',
                'translation' => 'Print'
            ),
            array(
                'id_record' => null,
                'id' => '0659',
                'language' => 'ua',
                'translation' => 'Завдання'
            ),
            array(
                'id_record' => null,
                'id' => '0658',
                'language' => 'ru',
                'translation' => 'Задание'
            ),
            array(
                'id_record' => null,
                'id' => '0658',
                'language' => 'en',
                'translation' => 'Quiz'
            ),
		));
	}

	public function down()
	{
        $this->delete('messages', 'id=656');
        $this->delete('sourcemessages', 'id=656');
        $this->delete('messages', 'id=657');
        $this->delete('sourcemessages', 'id=657');
        $this->delete('messages', 'id=658');
        $this->delete('sourcemessages', 'id=658');
        $this->delete('messages', 'id=659');
        $this->delete('sourcemessages', 'id=659');
	}
}