<?php

class m160413_114629_add_translations_817_828_months extends CDbMigration
{
	public function safeUp()
	{

		$start = 817;
		$category = 'month';

		$arrUa[$start] = 'січня';
		$arrRu[$start] = 'января';
		$arrEn[$start] = 'January';

		$arrUa[] = 'лютого';
		$arrRu[] = 'февраля';
		$arrEn[] = 'February';

		$arrUa[] = 'березня';
		$arrRu[] = 'марта';
		$arrEn[] = 'March';

		$arrUa[] = 'квітня';
		$arrRu[] = 'апреля';
		$arrEn[] = 'April';

		$arrUa[] = 'травня';
		$arrRu[] = 'мая';
		$arrEn[] = 'May';

		$arrUa[] = 'червня';
		$arrRu[] = 'июля';
		$arrEn[] = 'June';

		$arrUa[] = 'липня';
		$arrRu[] = 'июня';
		$arrEn[] = 'July';

		$arrUa[] = 'серпня';
		$arrRu[] = 'августа';
		$arrEn[] = 'August';

		$arrUa[] = 'вересня';
		$arrRu[] = 'сентября';
		$arrEn[] = 'September';

		$arrUa[] = 'жовтня';
		$arrRu[] = 'октября';
		$arrEn[] = 'October';

		$arrUa[] = 'листопада';
		$arrRu[] = 'ноября';
		$arrEn[] = 'November';

		$arrUa[] = 'грудня';
		$arrRu[] = 'декабря';
		$arrEn[] = 'December';

		for($i = $start; $i < $start + count($arrUa); $i++)
		{
			$this->insertMultiple('sourcemessages', array(
				array(
					'id' => $i,
					'category' => $category,
					'message' => '0'.$i
				)));


			$this->insertMultiple('translate', array(
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
		$start = 817;
		$end = 828;

		for($i = $start; $i <= $end; $i++)
		{
			$this->delete('translate', 'id='.$i);
			$this->delete('sourcemessages', 'id='.$i);
		}
	}
}