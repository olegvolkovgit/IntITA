<?php

class m151110_151956_add_translation_746_766 extends CDbMigration
{

	public function safeUp()
	{
        $start = 746;
        $category = 'graduate';

        $arrUa[$start] = 'Введіть ім\'я випускника.';
        $arrRu[$start] = 'Введите имя выпускника';
        $arrEn[$start] = 'Insert the name of the graduate';

        $arrUa[] = 'Введіть прізвище випускника.';
        $arrRu[] = 'Введите фамилию випускника';
        $arrEn[] = 'Insert the sur-name of the graduate';

        $arrUa[] = 'Рейтинг повинен бути числовим значенням.';
        $arrRu[] = 'Рейтинг должен быть числовым значением';
        $arrEn[] = 'Range should be integer value';

        $arrUa[] = 'Введіть дату в форматі РРРР-ММ-ДД';
        $arrRu[] = 'Введите дату в формате ГГГГ-ММ-ДД';
        $arrEn[] = 'Insert date in format YYYY-MM-DD';

        $arrUa[] = 'Дата закінчення не може бути раніше ніж 2012 рік.';
        $arrRu[] = 'Дата окончания не может быть раньше чем 2012 год';
        $arrEn[] = 'Release date can not be earlier than 2012 year';

        $arrUa[] = 'Дата закінчення не може бути пізніше ніж зараз.';
        $arrRu[] = 'Дата окончания не может быть позже чем сейчас';
        $arrEn[] = 'Release date can not be earlier than now';

        $arrUa[] = 'Ім\'я';
        $arrRu[] = 'Имя';
        $arrEn[] = 'First Name';

        $arrUa[] = 'Прізвище';
        $arrRu[] = 'Фамилия';
        $arrEn[] = 'Last Name';

        $arrUa[] = 'Аватар';
        $arrRu[] = 'Аватар';
        $arrEn[] = 'Avatar';

        $arrUa[] = 'Дата випуску';
        $arrRu[] = 'Дата выпуска';
        $arrEn[] = 'Graduate Date';

        $arrUa[] = 'Посада';
        $arrRu[] = 'Должность';
        $arrEn[] = 'Position';

        $arrUa[] = 'Місце роботи';
        $arrRu[] = 'Место работы';
        $arrEn[] = 'Place of Place';

        $arrUa[] = 'Посилання на місце роботи';
        $arrRu[] = 'Ссылка на место работы';
        $arrEn[] = 'Link on the place of work';

        $arrUa[] = 'Сторінка курсу';
        $arrRu[] = 'Страница курса';
        $arrEn[] = 'Page of the course';

        $arrUa[] = 'Історія';
        $arrRu[] = 'История';
        $arrEn[] = 'History';

        $arrUa[] = 'Рейтинг';
        $arrRu[] = 'Рейтинг';
        $arrEn[] = 'Rate';

        $arrUa[] = 'Відгук';
        $arrRu[] = 'Отзыв';
        $arrEn[] = 'Recall';

        $arrUa[] = 'Ім\'я англійською';
        $arrRu[] = 'Имя на английском';
        $arrEn[] = 'First name in English';

        $arrUa[] = 'Прізвище англійською';
        $arrRu[] = 'Фамилия на английском';
        $arrEn[] = 'Last Name in English';

        $arrUa[] = 'Рейтинг не може бути більше ніж 10';
        $arrRu[] = 'Рейтинг не может быть больше чем 10';
        $arrEn[] = 'Rating can not be large then 10';

        $arrUa[] = 'Рейтинг не може бути менше ніж 0';
        $arrRu[] = 'Рейтинг не может быть меньше чем 0';
        $arrEn[] = 'Rating can not be less then 10';


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

        $start = 746;
        $end = 766;

        for($i = $start; $i <= $end; $i++)
        {
            $this->delete('messages', 'id='.$i);
            $this->delete('sourcemessages', 'id='.$i);
        }
	}

}