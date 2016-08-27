<?php

class m160825_204941_add_translations_896_901 extends CDbMigration
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

		$this->addTranslate(896, 'regexp', '0896',
			[
				'ua' => 'виберіть країну',
				'ru' => 'выберите страну',
				'en' => 'select country'
			]);
		$this->addTranslate(897, 'regexp', '0897',
			[
				'ua' => 'країну',
				'ru' => 'страну',
				'en' => 'country'
			]);
		$this->addTranslate(898, 'regexp', '0898',
			[
				'ua' => 'виберіть місто або введіть власне',
				'ru' => 'выберите город или введите собственное',
				'en' => 'select city or enter your own'
			]);
		$this->addTranslate(899, 'regexp', '0899',
			[
				'ua' => 'місто',
				'ru' => 'город',
				'en' => 'city'
			]);
		$this->addTranslate(900, 'profile', '0900',
			[
				'ua' => 'Поточних модулів немає',
				'ru' => 'Текущих модулей нет',
				'en' => 'No current modules'
			]);
		$this->addTranslate(901, 'profile', '0901',
			[
				'ua' => 'Тренер',
				'ru' => 'Тренер',
				'en' => 'Trainer'
			]);
		return true;
	}

	public function safeDown() {
		return true;
	}
}