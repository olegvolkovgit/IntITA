<?php

class m151023_081952_add_translations_667_671 extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->insertMultiple('sourcemessages', array(
            array(
                'id' => '667',
                'category' => 'course',
                'message' => '0667'
            ),
            array(
                'id' => '668',
                'category' => 'course',
                'message' => '0668'
            ),
            array(
                'id' => '669',
                'category' => 'course',
                'message' => '0669'
            ),
            array(
                'id' => '670',
                'category' => 'course',
                'message' => '0670'
            ),
            array(
                'id' => '671',
                'category' => 'course',
                'message' => '0671'
            ),
        ));

        $this->insertMultiple('messages', array(
            array(
                'id_record' => null,
                'id' => '0667',
                'language' => 'ua',
                'translation' => 'місяці'
            ),
            array(
                'id_record' => null,
                'id' => '0667',
                'language' => 'ru',
                'translation' => 'месяца'
            ),
            array(
                'id_record' => null,
                'id' => '0667',
                'language' => 'en',
                'translation' => 'months'
            ),
            array(
                'id_record' => null,
                'id' => '0668',
                'language' => 'ua',
                'translation' => 'модулі'
            ),
            array(
                'id_record' => null,
                'id' => '0668',
                'language' => 'ru',
                'translation' => 'модули'
            ),
            array(
                'id_record' => null,
                'id' => '0668',
                'language' => 'en',
                'translation' => 'modules'
            ),
            array(
                'id_record' => null,
                'id' => '0669',
                'language' => 'ua',
                'translation' => 'Стажування'
            ),
            array(
                'id_record' => null,
                'id' => '0669',
                'language' => 'ru',
                'translation' => 'Стажировка'
            ),
            array(
                'id_record' => null,
                'id' => '0669',
                'language' => 'en',
                'translation' => 'Training'
            ),
            array(
                'id_record' => null,
                'id' => '0670',
                'language' => 'ua',
                'translation' => 'Схема проходження курсу'
            ),
            array(
                'id_record' => null,
                'id' => '0670',
                'language' => 'ru',
                'translation' => 'Схема прохождения курса'
            ),
            array(
                'id_record' => null,
                'id' => '0670',
                'language' => 'en',
                'translation' => 'Chart a course'
            ),
            array(
                'id_record' => null,
                'id' => '0671',
                'language' => 'ua',
                'translation' => 'Зберегти схему'
            ),
            array(
                'id_record' => null,
                'id' => '0671',
                'language' => 'ru',
                'translation' => 'Сохранить схему'
            ),
            array(
                'id_record' => null,
                'id' => '0671',
                'language' => 'en',
                'translation' => 'Save scheme'
            ),
        ));
	}

	public function safeDown()
	{
        $this->delete('messages', 'id=667');
        $this->delete('sourcemessages', 'id=667');
        $this->delete('messages', 'id=668');
        $this->delete('sourcemessages', 'id=668');
        $this->delete('messages', 'id=669');
        $this->delete('sourcemessages', 'id=669');
        $this->delete('messages', 'id=670');
        $this->delete('sourcemessages', 'id=670');
        $this->delete('messages', 'id=671');
        $this->delete('sourcemessages', 'id=671');
    }

}