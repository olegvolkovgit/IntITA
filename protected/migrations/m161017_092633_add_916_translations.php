<?php

class m161017_092633_add_916_translations extends CDbMigration
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

		$this->addTranslate(916, 'error', '0916',
			[
				'ua' => 'Обліковий запис заблоковано адміністратором',
				'ru' => 'Учётная запись заблокирована администратором',
				'en' => 'Account was blocked by Administrator'
			]);
		return true;
	}


	public function safeDown()
	{
		$this->delete('sourcemessages','message=0916');
		$this->delete('translate','id=916');
		return true;
	}

}