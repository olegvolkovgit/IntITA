<?php

class m151112_113620_add_translations_767_772 extends CDbMigration
{
	public function safeUp()
	{
		$start = 767;
		$category = 'lecture';

		$arrUa[$start] = 'Ви впевнені, що хочете видалити цей блок?';
		$arrRu[$start] = 'Вы уверены, что хотите удалить этот блок?';
		$arrEn[$start] = 'Are you sure you want to delete this block?';

		$arrUa[] = 'Щось пішло не так. Перевірте з\'єднання, перезавантажте сторінку та спробуйте ще раз. Якщо не допомогло - зв\'яжіться з адміністрацією.';
		$arrRu[] = 'Что-то пошло не так. Проверьте соединение, перезагрузите страницу и попробуйте еще раз. Если не помогло - свяжитесь с администрацией.';
		$arrEn[] = 'Something went wrong. Check the connection, reload the page and try again.  If this does not help - contact administration.';

		$arrUa[] = 'Закрийте попередні блоки перед редагуванням нового.';
		$arrRu[] = 'Закройте предыдущие блоки перед редактированием нового.';
		$arrEn[] = 'Close the previous blocks before editing a new one.';

		$arrUa[] = 'Збережено';
		$arrRu[] = 'Сохранено';
		$arrEn[] = 'Saved';

		$arrUa[] = 'Зберегти';
		$arrRu[] = 'Сохранить';
		$arrEn[] = 'Save';

		$arrUa[] = 'Закрити';
		$arrRu[] = 'Закрить';
		$arrEn[] = 'Close';

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

		$start = 767;
		$end = 772;

		for($i = $start; $i <= $end; $i++)
		{
			$this->delete('messages', 'id='.$i);
			$this->delete('sourcemessages', 'id='.$i);
		}
	}
}