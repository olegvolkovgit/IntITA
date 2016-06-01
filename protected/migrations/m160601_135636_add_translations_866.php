<?php

class m160601_135636_add_translations_866 extends CDbMigration
{
	public function up()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '866',
				'category' => 'exception',
				'message' => '0866'
			),
			array(
				'id' => '867',
				'category' => 'exception',
				'message' => '0867'
			),
			array(
				'id' => '868',
				'category' => 'exception',
				'message' => '0868'
			),
			array(
				'id' => '869',
				'category' => 'exception',
				'message' => '0869'
			),
			array(
				'id' => '870',
				'category' => 'exception',
				'message' => '0870'
			)
		));
		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0866',
				'language' => 'ua',
				'translation' => 'Курс видалений. Доступ до його матеріалів обмежений.'
			),
			array(
				'id_record' => null,
				'id' => '0866',
				'language' => 'ru',
				'translation' => 'Курс удаленный. Доступ к его материалам ограничен.'
			),
			array(
				'id_record' => null,
				'id' => '0866',
				'language' => 'en',
				'translation' => 'The course is remote. Access to the material it is limited.'
			),
			array(
				'id_record' => null,
				'id' => '0867',
				'language' => 'ua',
				'translation' => 'Даний модуль не входить до складу цього курса.'
			),
			array(
				'id_record' => null,
				'id' => '0867',
				'language' => 'ru',
				'translation' => 'Данный модуль не входит в состав этого курса.'
			),
			array(
				'id_record' => null,
				'id' => '0867',
				'language' => 'en',
				'translation' => 'This module is not part of this course.'
			),
			array(
				'id_record' => null,
				'id' => '0868',
				'language' => 'ua',
				'translation' => 'Для перегляду заняття спочатку авторизуйся'
			),
			array(
				'id_record' => null,
				'id' => '0868',
				'language' => 'ru',
				'translation' => 'Для просмотра занятия сначала авторизуйтесь'
			),
			array(
				'id_record' => null,
				'id' => '0868',
				'language' => 'en',
				'translation' => 'To view the lecture log in first'
			),
			array(
				'id_record' => null,
				'id' => '0869',
				'language' => 'ua',
				'translation' => 'Для доступу до заняття оплати курс або модуль'
			),
			array(
				'id_record' => null,
				'id' => '0869',
				'language' => 'ru',
				'translation' => 'Для доступа к занятию оплати курс или модуль'
			),
			array(
				'id_record' => null,
				'id' => '0869',
				'language' => 'en',
				'translation' => 'Pay first course or module'
			),
			array(
				'id_record' => null,
				'id' => '0870',
				'language' => 'ua',
				'translation' => 'Щоб отримати доступ до заняття пройди попередній матеріал'
			),
			array(
				'id_record' => null,
				'id' => '0870',
				'language' => 'ru',
				'translation' => 'Чтобы получить доступ к занятию пройти предварительный материал'
			),
			array(
				'id_record' => null,
				'id' => '0870',
				'language' => 'en',
				'translation' => 'To access the lesson a preliminary material'
			)
		));
	}

	public function down()
	{
		$this->delete('translate', 'id=866');
		$this->delete('sourcemessages', 'id=866');
		$this->delete('translate', 'id=867');
		$this->delete('sourcemessages', 'id=867');
		$this->delete('translate', 'id=868');
		$this->delete('sourcemessages', 'id=868');
		$this->delete('translate', 'id=869');
		$this->delete('sourcemessages', 'id=869');
		$this->delete('translate', 'id=870');
		$this->delete('sourcemessages', 'id=870');
	}
}