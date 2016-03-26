<?php

class m160321_121134_add_translation_800_816 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '800',
				'category' => 'editor',
				'message' => '0800'
			),
			array(
				'id' => '801',
				'category' => 'lecture',
				'message' => '0801'
			),
			array(
				'id' => '802',
				'category' => 'activeemail',
				'message' => '0802'
			),
			array(
				'id' => '803',
				'category' => 'activeemail',
				'message' => '0803'
			),
			array(
				'id' => '804',
				'category' => 'activeemail',
				'message' => '0804'
			),
			array(
				'id' => '805',
				'category' => 'validation',
				'message' => '0805'
			),
			array(
				'id' => '806',
				'category' => 'regform',
				'message' => '0806'
			),
			array(
				'id' => '807',
				'category' => 'mibew',
				'message' => '0807'
			),
			array(
				'id' => '808',
				'category' => 'module',
				'message' => '0808'
			),
			array(
				'id' => '809',
				'category' => 'course',
				'message' => '0809'
			),
			array(
				'id' => '810',
				'category' => 'lecture',
				'message' => '0810'
			),
			array(
				'id' => '811',
				'category' => 'lecture',
				'message' => '0811'
			),
			array(
				'id' => '812',
				'category' => 'lecture',
				'message' => '0812'
			),
			array(
				'id' => '813',
				'category' => 'lecture',
				'message' => '0813'
			),
			array(
				'id' => '814',
				'category' => 'lecture',
				'message' => '0814'
			),
			array(
				'id' => '815',
				'category' => 'profile',
				'message' => '0815'
			),
			array(
				'id' => '816',
				'category' => 'profile',
				'message' => '0816'
			)
		));

		$this->insertMultiple('translate', array(
			array(
				'id_record' => null,
				'id' => '0800',
				'language' => 'ua',
				'translation' => 'Завантажити'
			),
			array(
				'id_record' => null,
				'id' => '0800',
				'language' => 'ru',
				'translation' => 'Загрузить'
			),
			array(
				'id_record' => null,
				'id' => '0800',
				'language' => 'en',
				'translation' => 'Load'
			),
			array(
				'id_record' => null,
				'id' => '0801',
				'language' => 'ua',
				'translation' => 'Ти успішно пройшов(ла) модуль'
			),
			array(
				'id_record' => null,
				'id' => '0801',
				'language' => 'ru',
				'translation' => 'Ты успешно прошел(ла) модуль'
			),
			array(
				'id_record' => null,
				'id' => '0801',
				'language' => 'en',
				'translation' => 'You have successfully passed module'
			),
			array(
				'id_record' => null,
				'id' => '0802',
				'language' => 'ua',
				'translation' => 'Натисніть'
			),
			array(
				'id_record' => null,
				'id' => '0802',
				'language' => 'ru',
				'translation' => 'Нажмите'
			),
			array(
				'id_record' => null,
				'id' => '0802',
				'language' => 'en',
				'translation' => 'Click'
			),
			array(
				'id_record' => null,
				'id' => '0803',
				'language' => 'ua',
				'translation' => 'тут,'
			),
			array(
				'id_record' => null,
				'id' => '0803',
				'language' => 'ru',
				'translation' => 'здесь,'
			),
			array(
				'id_record' => null,
				'id' => '0803',
				'language' => 'en',
				'translation' => 'here'
			),
			array(
				'id_record' => null,
				'id' => '0804',
				'language' => 'ua',
				'translation' => 'щоб повторно відправити лист з активацією на електронну пошту:'
			),
			array(
				'id_record' => null,
				'id' => '0804',
				'language' => 'ru',
				'translation' => 'чтобы повторно отправить письмо с активацией на электронную почту:'
			),
			array(
				'id_record' => null,
				'id' => '0804',
				'language' => 'en',
				'translation' => 'to re-send an email with activation by email:'
			),
			array(
				'id_record' => null,
				'id' => '0805',
				'language' => 'ua',
				'translation' => 'Відповідь не може бути пустою'
			),
			array(
				'id_record' => null,
				'id' => '0805',
				'language' => 'ru',
				'translation' => 'Ответ не может быть пустой'
			),
			array(
				'id_record' => null,
				'id' => '0805',
				'language' => 'en',
				'translation' => 'The answer can not be empty'
			),
			array(
				'id_record' => null,
				'id' => '0806',
				'language' => 'ua',
				'translation' => 'Увійти'
			),
			array(
				'id_record' => null,
				'id' => '0806',
				'language' => 'ru',
				'translation' => 'Войти'
			),
			array(
				'id_record' => null,
				'id' => '0806',
				'language' => 'en',
				'translation' => 'Sign in'
			),
			array(
				'id_record' => null,
				'id' => '0807',
				'language' => 'ua',
				'translation' => 'Онлайн допомога'
			),
			array(
				'id_record' => null,
				'id' => '0807',
				'language' => 'ru',
				'translation' => 'Онлайн помощь'
			),
			array(
				'id_record' => null,
				'id' => '0807',
				'language' => 'en',
				'translation' => 'Online help'
			),
			array(
				'id_record' => null,
				'id' => '0808',
				'language' => 'ua',
				'translation' => 'Назад'
			),
			array(
				'id_record' => null,
				'id' => '0808',
				'language' => 'ru',
				'translation' => 'Назад'
			),
			array(
				'id_record' => null,
				'id' => '0808',
				'language' => 'en',
				'translation' => 'Cancel'
			),
			array(
				'id_record' => null,
				'id' => '0809',
				'language' => 'ua',
				'translation' => 'Вітаємо з завершенням!'
			),
			array(
				'id_record' => null,
				'id' => '0809',
				'language' => 'ru',
				'translation' => 'Поздравляем с завершением!'
			),
			array(
				'id_record' => null,
				'id' => '0809',
				'language' => 'en',
				'translation' => 'Congratulations!'
			),
			array(
				'id_record' => null,
				'id' => '0810',
				'language' => 'ua',
				'translation' => 'Заняття не існує'
			),
			array(
				'id_record' => null,
				'id' => '0810',
				'language' => 'ru',
				'translation' => 'Занятия не существует'
			),
			array(
				'id_record' => null,
				'id' => '0810',
				'language' => 'en',
				'translation' => 'Lecture not exist'
			),
			array(
				'id_record' => null,
				'id' => '0811',
				'language' => 'ua',
				'translation' => 'Заняття недоступне. Курс знаходиться в розробці.'
			),
			array(
				'id_record' => null,
				'id' => '0811',
				'language' => 'ru',
				'translation' => 'Занятия недоступно. Курс находится в разработке.'
			),
			array(
				'id_record' => null,
				'id' => '0811',
				'language' => 'en',
				'translation' => 'Lecture available. The course is under construction.'
			),
			array(
				'id_record' => null,
				'id' => '0812',
				'language' => 'ua',
				'translation' => 'Сторінка не знайдена'
			),
			array(
				'id_record' => null,
				'id' => '0812',
				'language' => 'ru',
				'translation' => 'Страница не найдена'
			),
			array(
				'id_record' => null,
				'id' => '0812',
				'language' => 'en',
				'translation' => 'Page not found'
			),
			array(
				'id_record' => null,
				'id' => '0813',
				'language' => 'ua',
				'translation' => 'Ти запросив сторінку, доступ до якої обмежений спеціальними правами.
				Для отримання доступу увійди на сайт з логіном автора модуля.'
			),
			array(
				'id_record' => null,
				'id' => '0813',
				'language' => 'ru',
				'translation' => 'Ты запросил страницу, доступ к которой ограничен специальными правами.
				Для получения доступа войди на сайт с логином автора модуля.'
			),
			array(
				'id_record' => null,
				'id' => '0813',
				'language' => 'en',
				'translation' => 'You are invited page, access to which is limited to special rights.
				To access Sign in with login module author.'
			),
			array(
				'id_record' => null,
				'id' => '0814',
				'language' => 'ua',
				'translation' => 'Блок не може бути пустий'
			),
			array(
				'id_record' => null,
				'id' => '0814',
				'language' => 'ru',
				'translation' => 'Блок не может быть пустой'
			),
			array(
				'id_record' => null,
				'id' => '0814',
				'language' => 'en',
				'translation' => 'The block can not be empty'
			),
			array(
				'id_record' => null,
				'id' => '0815',
				'language' => 'ua',
				'translation' => 'Мій кабінет'
			),
			array(
				'id_record' => null,
				'id' => '0815',
				'language' => 'ru',
				'translation' => 'Мой кабинет'
			),
			array(
				'id_record' => null,
				'id' => '0815',
				'language' => 'en',
				'translation' => 'My cabinet'
			),
			array(
				'id_record' => null,
				'id' => '0816',
				'language' => 'ua',
				'translation' => 'Договори'
			),
			array(
				'id_record' => null,
				'id' => '0816',
				'language' => 'ru',
				'translation' => 'Договоры'
			),
			array(
				'id_record' => null,
				'id' => '0816',
				'language' => 'en',
				'translation' => 'Agreements'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('translate', 'id=800');
		$this->delete('sourcemessages', 'id=800');
		$this->delete('translate', 'id=801');
		$this->delete('sourcemessages', 'id=801');
		$this->delete('translate', 'id=802');
		$this->delete('sourcemessages', 'id=802');
		$this->delete('translate', 'id=803');
		$this->delete('sourcemessages', 'id=803');
		$this->delete('translate', 'id=804');
		$this->delete('sourcemessages', 'id=804');
		$this->delete('translate', 'id=805');
		$this->delete('sourcemessages', 'id=805');
		$this->delete('translate', 'id=806');
		$this->delete('sourcemessages', 'id=806');
		$this->delete('translate', 'id=807');
		$this->delete('sourcemessages', 'id=807');
		$this->delete('translate', 'id=808');
		$this->delete('sourcemessages', 'id=808');
		$this->delete('translate', 'id=809');
		$this->delete('sourcemessages', 'id=809');
		$this->delete('translate', 'id=810');
		$this->delete('sourcemessages', 'id=810');
		$this->delete('translate', 'id=811');
		$this->delete('sourcemessages', 'id=811');
		$this->delete('translate', 'id=812');
		$this->delete('sourcemessages', 'id=812');
		$this->delete('translate', 'id=813');
		$this->delete('sourcemessages', 'id=813');
		$this->delete('translate', 'id=814');
		$this->delete('sourcemessages', 'id=814');
		$this->delete('translate', 'id=815');
		$this->delete('sourcemessages', 'id=815');
		$this->delete('translate', 'id=816');
		$this->delete('sourcemessages', 'id=816');
	}
}