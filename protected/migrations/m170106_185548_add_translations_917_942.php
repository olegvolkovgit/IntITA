<?php

class m170106_185548_add_translations_917_942 extends CDbMigration
{
	private function addTranslate($id, $category, $message, $translates) {
		$this->insert('sourcemessages', [
			'id' => $id,
			'category' => $category,
			'message' => $message
		]);

		foreach ($translates as $lang => $translation) {
			$this->insert('translate',
				[
					'id' => $id,
					'language' => $lang,
					'translation' => $translation
				]);
		}

	}
	public function safeUp() {

		$this->addTranslate(917, 'header', '0917',
			[
				'ua' => 'Продовжити',
				'ru' => 'Продолжить',
				'en' => 'Continue'
			]);
		$this->addTranslate(918, 'courses', '0918',
			[
				'ua' => 'Усі модулі',
				'ru' => 'Все модули',
				'en' => 'All modules'
			]);
		$this->addTranslate(919, 'regexp', '0919',
			[
				'ua' => 'Укладення договору',
				'ru' => 'Заключение договора',
				'en' => 'Conclusion of the contract'
			]);
		$this->addTranslate(920, 'regexp', '0920',
			[
				'ua' => 'Попередня зайнятість',
				'ru' => 'Предыдущая занятость',
				'en' => 'Previous employment'
			]);
		$this->addTranslate(921, 'regexp', '0921',
			[
				'ua' => 'Теперішня зайнятість',
				'ru' => 'Нынешняя занятость',
				'en' => 'The current employment'
			]);
		$this->addTranslate(922, 'regexp', '0922',
			[
				'ua' => "Початок кар'єри",
				'ru' => 'Начало карьеры',
				'en' => 'Career start'
			]);
		$this->addTranslate(923, 'regexp', '0923',
			[
				'ua' => "Як би ти хотів розпочати кар'єру в IT?",
				'ru' => 'Как бы ты хотел начать карьеру в IT?',
				'en' => 'How would you like to start a career in IT?'
			]);
		$this->addTranslate(924, 'regexp', '0924',
			[
				'ua' => 'Спеціалізація',
				'ru' => 'Специализация',
				'en' => 'Specialization'
			]);
		$this->addTranslate(925, 'regexp', '0925',
			[
				'ua' => 'Обери спеціалізацію',
				'ru' => 'Выберите специализацию',
				'en' => 'Select specialization'
			]);
		$this->addTranslate(926, 'regexp', '0926',
			[
				'ua' => 'Навчальна зміна',
				'ru' => 'Учебная смена',
				'en' => 'Educational shift'
			]);
		$this->addTranslate(927, 'regexp', '0927',
			[
				'ua' => 'Серія/номер паспорта',
				'ru' => 'Серия/номер паспорта',
				'en' => 'Passport number'
			]);
		$this->addTranslate(928, 'regexp', '0928',
			[
				'ua' => 'Ким виданий паспорт',
				'ru' => 'Кем выдан паспорт',
				'en' => 'Issued passport'
			]);
		$this->addTranslate(929, 'regexp', '0929',
			[
				'ua' => 'Дата видачі паспорта',
				'ru' => 'Дата выдачи паспорта',
				'en' => 'Date of issue of passport'
			]);
		$this->addTranslate(930, 'regexp', '0930',
			[
				'ua' => 'Ідентифікаційний код',
				'ru' => 'Идентификационный код',
				'en' => 'Identification code'
			]);
		$this->addTranslate(931, 'regexp', '0931',
			[
				'ua' => 'Ким працював (чим займався) раніше?',
				'ru' => 'Кем работал (чем занимался) раньше?',
				'en' => 'What did you do before?'
			]);
		$this->addTranslate(932, 'regexp', '0932',
			[
				'ua' => 'Де працюєш (чим займаєшся) зараз? Години зайнятості?',
				'ru' => 'Где работаешь (чем занимаешься) сейчас? Часы занятости?',
				'en' => 'Where do you work now? Hours of employment?'
			]);
		$this->addTranslate(933, 'edit', '0933',
			[
				'ua' => 'попередню зайнятість',
				'ru' => 'предыдущую занятость',
				'en' => 'previous employment'
			]);
		$this->addTranslate(934, 'edit', '0934',
			[
				'ua' => 'теперішню зайнятість',
				'ru' => 'нынешнюю занятость',
				'en' => 'current employment'
			]);
		$this->addTranslate(935, 'edit', '0935',
			[
				'ua' => 'номер паспорта',
				'ru' => 'номер паспорта',
				'en' => 'passport number'
			]);
		$this->addTranslate(936, 'edit', '0936',
			[
				'ua' => 'ким виданий паспорт',
				'ru' => 'кем выдан паспорт',
				'en' => 'issued passport'
			]);
		$this->addTranslate(937, 'edit', '0937',
			[
				'ua' => 'дату видачі паспорта',
				'ru' => 'дату выдачи паспорта',
				'en' => 'date of issue of passport'
			]);
		$this->addTranslate(938, 'edit', '0938',
			[
				'ua' => 'ідентифікаційний код',
				'ru' => 'идентификационный код',
				'en' => 'identification code'
			]);
		$this->addTranslate(939, 'edit', '0939',
			[
				'ua' => 'Копія паспорта',
				'ru' => 'Копия паспорта',
				'en' => 'Copy of passport'
			]);
		$this->addTranslate(940, 'edit', '0940',
			[
				'ua' => 'Копія кода',
				'ru' => 'Копия кода',
				'en' => 'Copy of code'
			]);
		$this->addTranslate(941, 'edit', '0941',
			[
				'ua' => "початок кар'єри",
				'ru' => 'начало карьеры',
				'en' => 'career start'
			]);
		$this->addTranslate(942, 'edit', '0942',
			[
				'ua' => 'спеціалізації, яким надано перевагу',
				'ru' => 'специализации, которым предоставлено преимущество',
				'en' => 'specializations'
			]);
		return true;
	}

	public function safeDown() {
		return true;
	}
}