<?php

class m160928_133351_add_translations_912_915 extends CDbMigration
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

		$this->addTranslate(912, 'header', '0912',
			[
				'ua' => 'Події',
				'ru' => 'События',
				'en' => 'Events'
			]);
		$this->addTranslate(913, 'validation', '0913',
			[
				'ua' => 'Введіть вік від 16 до 100',
				'ru' => 'Введите возраст от 16 до 100',
				'en' => 'Enter the age from 16 to 100'
			]);
		$this->addTranslate(914, 'letter', '0914',
			[
				'ua' => 'Лист успішно відправлено',
				'ru' => 'Письмо успешно отправлено',
				'en' => 'Mail sent successfully'
			]);
		$this->addTranslate(915, 'letter', '0915',
			[
				'ua' => 'Відправити лист не вдалося, зв\'яжіться з адміністрацією',
				'ru' => 'Отправить письмо не удалось, свяжитесь с администрацией',
				'en' => 'Send a letter failed'
			]);
		return true;
	}

	public function safeDown() {
		return true;
	}
}