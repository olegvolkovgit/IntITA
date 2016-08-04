<?php

class m160722_115523_add_translations_893_895 extends CDbMigration
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

		$this->addTranslate(893, 'module', '0893',
			[
				'ua' => 'Стан модуля',
				'ru' => 'Состояние модуля',
				'en' => 'State of the module'
			]);
		$this->addTranslate(894, 'lecture', '0894',
			[
				'ua' => 'Заняття недоступне. Модуль знаходиться в розробці',
				'ru' => 'Занятия недоступно. Модуль находится в разработке',
				'en' => 'Lecture available. The module is in development'
			]);
		$this->addTranslate(895, 'revision', 'RevisionCourseCancelledAuthorState',
			[
				'ua' => 'Скасований автором',
				'ru' => 'Отменен автором',
				'en' => 'Canceled by the author'
			]);
		return true;
	}

	public function safeDown() {
		return true;
	}
}