<?php

class m151113_114517_add_translation_773_775 extends CDbMigration
{
	public function up()
	{
        $start = 773;
        $category = 'lecture';

        $arrUa[$start] = 'Введіть просту задачу';
        $arrRu[$start] = 'Введите простую задачу';
        $arrEn[$start] = 'Enter the simple task';

        $arrUa[] = 'Завдання';
        $arrRu[] = 'Задание';
        $arrEn[] = 'Task';

        $arrUa[] = 'Автор';
        $arrRu[] = 'Автор';
        $arrEn[] = 'Author';

        for($i = $start; $i < $start + count($arrUa); $i++) {
            $this->insertMultiple('sourcemessages', array(
                array(
                    'id' => $i,
                    'category' => $category,
                    'message' => '0' . $i
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

	public function down()
	{
        $start = 773;
        $end = 775;

        for($i = $start; $i <= $end; $i++)
        {
            $this->delete('messages', 'id='.$i);
            $this->delete('sourcemessages', 'id='.$i);
        }
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}