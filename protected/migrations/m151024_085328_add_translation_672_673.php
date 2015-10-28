<?php

class m151024_085328_add_translation_672_673 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '672',
				'category' => 'error',
				'message' => '0672'
			),
			array(
				'id' => '673',
				'category' => 'course',
				'message' => '0673'
			),
			array(
				'id' => '674',
				'category' => 'lecture',
				'message' => '0674'
			),
			array(
				'id' => '675',
				'category' => 'lecture',
				'message' => '0675'
			),
			array(
				'id' => '676',
				'category' => 'lecture',
				'message' => '0676'
			),
			array(
				'id' => '677',
				'category' => 'lecture',
				'message' => '0677'
			),
			array(
				'id' => '678',
				'category' => 'lecture',
				'message' => '0678'
			),
			array(
				'id' => '679',
				'category' => 'lecture',
				'message' => '0679'
			),
			array(
				'id' => '680',
				'category' => 'lecture',
				'message' => '0680'
			),
			array(
				'id' => '681',
				'category' => 'lecture',
				'message' => '0681'
			),
			array(
				'id' => '682',
				'category' => 'lecture',
				'message' => '0682'
			),
			array(
				'id' => '683',
				'category' => 'lecture',
				'message' => '0683'
			),
			array(
				'id' => '684',
				'category' => 'validation',
				'message' => '0684'
			),
			array(
				'id' => '685',
				'category' => 'validation',
				'message' => '0685'
			),
		));

		$this->insertMultiple('messages', array(
			array(
				'id_record' => null,
				'id' => '0672',
				'language' => 'ua',
				'translation' => 'Невірний формат файлу'
			),
			array(
				'id_record' => null,
				'id' => '0672',
				'language' => 'ru',
				'translation' => 'Неверный формат файла'
			),
			array(
				'id_record' => null,
				'id' => '0672',
				'language' => 'en',
				'translation' => 'Invalid file format'
			),
			array(
				'id_record' => null,
				'id' => '0673',
				'language' => 'ua',
				'translation' => 'Екзамен'
			),
			array(
				'id_record' => null,
				'id' => '0673',
				'language' => 'ru',
				'translation' => 'Экзамен'
			),
			array(
				'id_record' => null,
				'id' => '0673',
				'language' => 'en',
				'translation' => 'Exam'
			),
			array(
				'id_record' => null,
				'id' => '0674',
				'language' => 'ua',
				'translation' => 'НАСТУПНЕ ЗАНЯТТЯ />'
			),
			array(
				'id_record' => null,
				'id' => '0674',
				'language' => 'ru',
				'translation' => 'СЛЕДУЮЩЕЕ ЗАНЯТИЕ />'
			),
			array(
				'id_record' => null,
				'id' => '0674',
				'language' => 'en',
				'translation' => 'NEXT LECTURE />'
			),
			array(
				'id_record' => null,
				'id' => '0675',
				'language' => 'ua',
				'translation' => 'Вітаємо!'
			),
			array(
				'id_record' => null,
				'id' => '0675',
				'language' => 'ru',
				'translation' => 'Поздравляем!'
			),
			array(
				'id_record' => null,
				'id' => '0675',
				'language' => 'en',
				'translation' => 'Congratulations!'
			),
			array(
				'id_record' => null,
				'id' => '0676',
				'language' => 'ua',
				'translation' => 'Ти успішно пройшов(ла) заняття!'
			),
			array(
				'id_record' => null,
				'id' => '0676',
				'language' => 'ru',
				'translation' => 'Ты успешно прошел (а) занятие!'
			),
			array(
				'id_record' => null,
				'id' => '0676',
				'language' => 'en',
				'translation' => 'You successfully completed lecture!'
			),
			array(
				'id_record' => null,
				'id' => '0677',
				'language' => 'ua',
				'translation' => 'Також можеш'
			),
			array(
				'id_record' => null,
				'id' => '0677',
				'language' => 'ru',
				'translation' => 'Также можешь'
			),
			array(
				'id_record' => null,
				'id' => '0677',
				'language' => 'en',
				'translation' => 'Also you can'
			),
			array(
				'id_record' => null,
				'id' => '0678',
				'language' => 'ua',
				'translation' => 'поділитися успіхом у соціальних мережах:'
			),
			array(
				'id_record' => null,
				'id' => '0678',
				'language' => 'ru',
				'translation' => 'поделиться успехом в социальных сетях:'
			),
			array(
				'id_record' => null,
				'id' => '0678',
				'language' => 'en',
				'translation' => 'share success with social networks:'
			),
			array(
				'id_record' => null,
				'id' => '0679',
				'language' => 'ua',
				'translation' => 'Ти успішно вирішив(ла) завдання! Тепер ти можеш перейти до наступного матеріалу!'
			),
			array(
				'id_record' => null,
				'id' => '0679',
				'language' => 'ru',
				'translation' => 'Ты успешно решил (а) задание! Теперь ты можешь перейти к следующему материалу!'
			),
			array(
				'id_record' => null,
				'id' => '0679',
				'language' => 'en',
				'translation' => 'You successfully solved task! Now you can move to the next material!'
			),
			array(
				'id_record' => null,
				'id' => '0680',
				'language' => 'ua',
				'translation' => 'ЗАКРИТИ />'
			),
			array(
				'id_record' => null,
				'id' => '0680',
				'language' => 'ru',
				'translation' => 'ЗАКРЫТЬ />'
			),
			array(
				'id_record' => null,
				'id' => '0680',
				'language' => 'en',
				'translation' => 'CLOSE />'
			),
			array(
				'id_record' => null,
				'id' => '0681',
				'language' => 'ua',
				'translation' => 'ДАЛІ />'
			),
			array(
				'id_record' => null,
				'id' => '0681',
				'language' => 'ru',
				'translation' => 'ДАЛЬШЕ />'
			),
			array(
				'id_record' => null,
				'id' => '0681',
				'language' => 'en',
				'translation' => 'NEXT />'
			),
			array(
				'id_record' => null,
				'id' => '0682',
				'language' => 'ua',
				'translation' => 'Помилка!'
			),
			array(
				'id_record' => null,
				'id' => '0682',
				'language' => 'ru',
				'translation' => 'Ошибка!'
			),
			array(
				'id_record' => null,
				'id' => '0682',
				'language' => 'en',
				'translation' => 'Error!'
			),
			array(
				'id_record' => null,
				'id' => '0683',
				'language' => 'ua',
				'translation' => 'Щось пішло неправильно, виправ помилку та переходь до наступного матеріалу.'
			),
			array(
				'id_record' => null,
				'id' => '0683',
				'language' => 'ru',
				'translation' => 'Что-то пошло не правильно, исправь ошибку и перехода к следующему материалу.'
			),
			array(
				'id_record' => null,
				'id' => '0683',
				'language' => 'en',
				'translation' => 'Something went right, correct errors and move to the next material.'
			),
			array(
				'id_record' => null,
				'id' => '0684',
				'language' => 'ua',
				'translation' => 'Введіть назву в потрібному форматі або заповніть поле'
			),
			array(
				'id_record' => null,
				'id' => '0684',
				'language' => 'ru',
				'translation' => 'Введите название в нужном формате или заполните поле'
			),
			array(
				'id_record' => null,
				'id' => '0684',
				'language' => 'en',
				'translation' => 'Enter a name in the correct format, or fill out the form'
			),
			array(
				'id_record' => null,
				'id' => '0685',
				'language' => 'ua',
				'translation' => 'Введіть назву в потрібному форматі'
			),
			array(
				'id_record' => null,
				'id' => '0685',
				'language' => 'ru',
				'translation' => 'Введите название в нужном формате'
			),
			array(
				'id_record' => null,
				'id' => '0685',
				'language' => 'en',
				'translation' => 'Enter a name in the proper format'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('messages', 'id=672');
		$this->delete('sourcemessages', 'id=672');
		$this->delete('messages', 'id=673');
		$this->delete('sourcemessages', 'id=673');
		$this->delete('messages', 'id=674');
		$this->delete('sourcemessages', 'id=674');
		$this->delete('messages', 'id=675');
		$this->delete('sourcemessages', 'id=675');
		$this->delete('messages', 'id=676');
		$this->delete('sourcemessages', 'id=676');
		$this->delete('messages', 'id=677');
		$this->delete('sourcemessages', 'id=677');
		$this->delete('messages', 'id=678');
		$this->delete('sourcemessages', 'id=678');
		$this->delete('messages', 'id=679');
		$this->delete('sourcemessages', 'id=679');
		$this->delete('messages', 'id=680');
		$this->delete('sourcemessages', 'id=680');
		$this->delete('messages', 'id=681');
		$this->delete('sourcemessages', 'id=681');
		$this->delete('messages', 'id=682');
		$this->delete('sourcemessages', 'id=682');
		$this->delete('messages', 'id=683');
		$this->delete('sourcemessages', 'id=683');
		$this->delete('messages', 'id=684');
		$this->delete('sourcemessages', 'id=684');
		$this->delete('messages', 'id=685');
		$this->delete('sourcemessages', 'id=685');
	}
}