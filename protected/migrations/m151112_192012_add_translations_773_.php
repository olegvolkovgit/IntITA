<?php

class m151112_192012_add_translations_773_ extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '776',
				'category' => 'lecture',
				'message' => '0776'
			),
			array(
				'id' => '777',
				'category' => 'activeemail',
				'message' => '0777'
			),
			array(
				'id' => '778',
				'category' => 'verification',
				'message' => '0778'
			),
		));

		$this->insertMultiple('messages', array(
			array(
				'id_record' => null,
				'id' => '0776',
				'language' => 'ua',
				'translation' => 'Поле не може бути пустим'
			),
			array(
				'id_record' => null,
				'id' => '0776',
				'language' => 'ru',
				'translation' => 'Поле не может быть пустым'
			),
			array(
				'id_record' => null,
				'id' => '0776',
				'language' => 'en',
				'translation' => 'The field can not be empty'
			),
			array(
				'id_record' => null,
				'id' => '0777',
				'language' => 'ua',
				'translation' => 'Тепер ваша реєстрація завершена. Тепер ви можете увійти на сайт під вашим обліковим записом соціальної мережі.'
			),
			array(
				'id_record' => null,
				'id' => '0777',
				'language' => 'ru',
				'translation' => 'Теперь ваша регистрация завершена. Теперь вы можете войти на сайт под учетной записью социальной сети.'
			),
			array(
				'id_record' => null,
				'id' => '0777',
				'language' => 'en',
				'translation' => 'Now your registration is complete. Now you can log in to your account social network.'
			),
			array(
				'id_record' => null,
				'id' => '0778',
				'language' => 'ua',
				'translation' => 'Введіть електронну пошту в поле нижче для прив\'язки її до вашого аккаунта в соціальній мережі. На дану електронну пошту буде відправлено посилання для підтвердження дійсності адреси.'
			),
			array(
				'id_record' => null,
				'id' => '0778',
				'language' => 'ru',
				'translation' => 'Введите электронную почту в поле ниже для привязки ее к вашему аккаунта в социальной сети. На эту электронную почту будет отправлено ссылки для подтверждения подлинности адреса.'
			),
			array(
				'id_record' => null,
				'id' => '0778',
				'language' => 'en',
				'translation' => 'Enter your email in the box below to assign it to your account in a social network. In this e-mail will be sent a link to confirm the validity of the address.'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('messages', 'id=776');
		$this->delete('sourcemessages', 'id=776');
		$this->delete('messages', 'id=777');
		$this->delete('sourcemessages', 'id=777');
		$this->delete('messages', 'id=778');
		$this->delete('sourcemessages', 'id=778');
	}
}