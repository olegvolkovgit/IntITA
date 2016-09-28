<?php

class m160928_133351_add_translations_912 extends CDbMigration
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
		return true;
	}

	public function safeDown() {
		return true;
	}
}