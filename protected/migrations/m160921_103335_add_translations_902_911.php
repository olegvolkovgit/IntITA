<?php

class m160921_103335_add_translations_902_911 extends CDbMigration
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

		$this->addTranslate(902, 'header', '0902',
			[
				'ua' => 'Вакансії',
				'ru' => 'Вакансии',
				'en' => 'Vacancies'
			]);
		$this->addTranslate(903, 'courses', '0903',
			[
				'ua' => 'категорії',
				'ru' => 'категории',
				'en' => 'categories'
			]);
		$this->addTranslate(904, 'course', '0904',
			[
				'ua' => 'Про курс',
				'ru' => 'О курсе',
				'en' => 'About the course'
			]);
		$this->addTranslate(905, 'revision', '0905',
			[
				'ua' => 'Ревізії',
				'ru' => 'Ревизии',
				'en' => 'Revisions'
			]);
		$this->addTranslate(906, 'revision', '0906',
			[
				'ua' => 'Ревізії модуля',
				'ru' => 'Ревизии модуля',
				'en' => 'Revisions module'
			]);
		$this->addTranslate(907, 'revision', '0907',
			[
				'ua' => 'Ревізії занять модуля',
				'ru' => 'Ревизии занятий модуля',
				'en' => 'Revisions module lectures'
			]);
		$this->addTranslate(908, 'revision', '0908',
			[
				'ua' => 'Ревізії курсу',
				'ru' => 'Ревизии курса',
				'en' => 'Revisions сourse'
			]);
		$this->addTranslate(909, 'revision', '0909',
			[
				'ua' => 'Ревізії модулів курсу',
				'ru' => 'Ревизии модулей курса',
				'en' => 'Revisions course modules'
			]);
		$this->addTranslate(910, 'module', '0910',
			[
				'ua' => 'Запит',
				'ru' => 'Запрос',
				'en' => 'Request'
			]);
		$this->addTranslate(911, 'module', '0911',
			[
				'ua' => 'Запит на редагування модуля',
				'ru' => 'Запрос на редактирование модуля',
				'en' => 'Request editing module'
			]);
		return true;
	}

	public function safeDown() {
		return true;
	}
}