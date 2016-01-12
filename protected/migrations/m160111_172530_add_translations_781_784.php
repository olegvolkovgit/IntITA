<?php

class m160111_172530_add_translations_781_784 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '781',
				'category' => 'breadcrumbs',
				'message' => '0781'
			),
			array(
				'id' => '782',
				'category' => 'breadcrumbs',
				'message' => '0782'
			),
			array(
				'id' => '783',
				'category' => 'breadcrumbs',
				'message' => '0783'
			),
			array(
				'id' => '784',
				'category' => 'breadcrumbs',
				'message' => '0784'
			)
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0781',
				'language' => 'ua',
				'translation' => 'Неправильний запит'
			),
			array(
				'id_record' => null,
				'id' => '0781',
				'language' => 'ru',
				'translation' => 'Неправильный запрос'
			),
			array(
				'id_record' => null,
				'id' => '0781',
				'language' => 'en',
				'translation' => 'Bad Request'
			),
			array(
				'id_record' => null,
				'id' => '0782',
				'language' => 'ua',
				'translation' => 'Сторінка не знайдена'
			),
			array(
				'id_record' => null,
				'id' => '0782',
				'language' => 'ru',
				'translation' => 'Страница не найдена'
			),
			array(
				'id_record' => null,
				'id' => '0782',
				'language' => 'en',
				'translation' => 'Not Found'
			),
			array(
				'id_record' => null,
				'id' => '0783',
				'language' => 'ua',
				'translation' => 'Помилка сервера'
			),
			array(
				'id_record' => null,
				'id' => '0783',
				'language' => 'ru',
				'translation' => 'Ошибка сервера'
			),
			array(
				'id_record' => null,
				'id' => '0783',
				'language' => 'en',
				'translation' => 'Internal Server Error'
			),
			array(
				'id_record' => null,
				'id' => '0784',
				'language' => 'ua',
				'translation' => 'Помилка'
			),
			array(
				'id_record' => null,
				'id' => '0784',
				'language' => 'ru',
				'translation' => 'Ошибка'
			),
			array(
				'id_record' => null,
				'id' => '0784',
				'language' => 'en',
				'translation' => 'Error'
			)
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=781');
		$this->delete('sourcemessages', 'id=781');
		$this->delete('translate', 'id=782');
		$this->delete('sourcemessages', 'id=782');
		$this->delete('translate', 'id=783');
		$this->delete('sourcemessages', 'id=783');
		$this->delete('translate', 'id=784');
		$this->delete('sourcemessages', 'id=784');
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