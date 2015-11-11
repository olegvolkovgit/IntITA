<?php

class m151111_162027_add_translations_740_745 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '740',
				'category' => 'lecture',
				'message' => '0740'
			),
			array(
				'id' => '741',
				'category' => 'lecture',
				'message' => '0741'
			),
			array(
				'id' => '742',
				'category' => 'lecture',
				'message' => '0742'
			),
			array(
				'id' => '743',
				'category' => 'lecture',
				'message' => '0743'
			),
			array(
				'id' => '744',
				'category' => 'lecture',
				'message' => '0744'
			),
			array(
				'id' => '745',
				'category' => 'lecture',
				'message' => '0745'
			),
        ));

		$this->insertMultiple('messages', array(
			array(
				'id_record' => null,
				'id' => '0740',
				'language' => 'ua',
				'translation' => 'Ви впевнені, що хочете видалити цей блок?'
			),
			array(
				'id_record' => null,
				'id' => '0740',
				'language' => 'ru',
				'translation' => 'Вы уверены, что хотите удалить этот блок?'
			),
			array(
				'id_record' => null,
				'id' => '0740',
				'language' => 'en',
				'translation' => 'Are you sure you want to delete this block?'
			),
			array(
				'id_record' => null,
				'id' => '0741',
				'language' => 'ua',
				'translation' => 'Щось пішло не так. Перевірте з\'єднання, перезавантажте сторінку та спробуйте ще раз. Якщо не допомогло - зв\'яжіться з адміністрацією.'
			),
			array(
				'id_record' => null,
				'id' => '0741',
				'language' => 'ru',
				'translation' => 'Что-то пошло не так. Проверьте соединение, перезагрузите страницу и попробуйте еще раз. Если не помогло - свяжитесь с администрацией.'
			),
			array(
				'id_record' => null,
				'id' => '0741',
				'language' => 'en',
				'translation' => 'Something went wrong. Check the connection, reload the page and try again.  If this does not help - contact administration.'
			),
			array(
				'id_record' => null,
				'id' => '0742',
				'language' => 'ua',
				'translation' => 'Закрийте попередні блоки перед редагуванням нового.'
			),
			array(
				'id_record' => null,
				'id' => '0742',
				'language' => 'ru',
				'translation' => 'Закройте предыдущие блоки перед редактированием нового.'
			),
			array(
				'id_record' => null,
				'id' => '0742',
				'language' => 'en',
				'translation' => 'Close the previous blocks before editing a new one.'
			),
			array(
				'id_record' => null,
				'id' => '0743',
				'language' => 'ua',
				'translation' => 'Збережено'
			),
			array(
				'id_record' => null,
				'id' => '0743',
				'language' => 'ru',
				'translation' => 'Сохранено'
			),
			array(
				'id_record' => null,
				'id' => '0743',
				'language' => 'en',
				'translation' => 'Saved'
			),
			array(
				'id_record' => null,
				'id' => '0744',
				'language' => 'ua',
				'translation' => 'Зберегти'
			),
			array(
				'id_record' => null,
				'id' => '0744',
				'language' => 'ru',
				'translation' => 'Сохранить'
			),
			array(
				'id_record' => null,
				'id' => '0744',
				'language' => 'en',
				'translation' => 'Save'
			),
			array(
				'id_record' => null,
				'id' => '0745',
				'language' => 'ua',
				'translation' => 'Закрити'
			),
			array(
				'id_record' => null,
				'id' => '0745',
				'language' => 'ru',
				'translation' => 'Закрить'
			),
			array(
				'id_record' => null,
				'id' => '0745',
				'language' => 'en',
				'translation' => 'Close'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('messages', 'id=740');
		$this->delete('sourcemessages', 'id=740');
		$this->delete('messages', 'id=741');
		$this->delete('sourcemessages', 'id=741');
		$this->delete('messages', 'id=742');
		$this->delete('sourcemessages', 'id=742');
		$this->delete('messages', 'id=743');
		$this->delete('sourcemessages', 'id=743');
		$this->delete('messages', 'id=744');
		$this->delete('sourcemessages', 'id=744');
		$this->delete('messages', 'id=745');
		$this->delete('sourcemessages', 'id=745');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}