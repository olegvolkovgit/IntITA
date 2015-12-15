<?php

class m151110_135230_add_translation_740_745 extends CDbMigration
{

	public function safeUp()
	{

        $start = 740;
        $category = 'course';
        $arrUa[$start] = 'Псевдонім має бути унікальним';
        $arrRu[$start] = 'Псевдоним должен быть уникальным';
        $arrEn[$start] = 'Alias must unique';

        $arrUa[] = 'Видалений';
        $arrRu[] = 'Удаленний';
        $arrEn[] = 'Removed';

        $arrUa[] = 'Номер курсу';
        $arrRu[] = 'Номер курса';
        $arrEn[] = 'Number of course';

        $arrUa[] = 'Назва англійською';
        $arrRu[] = 'Название на английском';
        $arrEn[] = 'Title in english';

        $arrUa[] = 'Назва россійською';
        $arrRu[] = 'Название на руском';
        $arrEn[] = 'Title in russian';

        $arrUa[] = 'Псевдонім';
        $arrRu[] = 'Псевдоним';
        $arrEn[] = 'Alias';
        for($i = $start; $i < $start + count($arrUa); $i++)
        {
            $this->insertMultiple('sourcemessages', array(
                array(
                    'id' => $i,
                    'category' => $category,
                    'message' => '0'.$i
                )));


            $this->insertMultiple('messages', array(
                array(
                    'id_record' => null,
                    'id' => $i,
                    'language' => 'ua',
                    'translation' => $arrUa[$i]
                ),
                array(
                    'id_record' => null,
                    'id' => $i,
                    'language' => 'ru',
                    'translation' => $arrRu[$i]
                ),
                array(
                    'id_record' => null,
                    'id' => $i,
                    'language' => 'en',
                    'translation' => $arrEn[$i]
                )));
        }

    }

	public function safeDown()
	{
        $start = 740;
        $end = 745;

        for($i = $start; $i <= $end; $i++)
        {
            $this->delete('messages', 'id='.$i);
            $this->delete('sourcemessages', 'id='.$i);
        }

    }

}