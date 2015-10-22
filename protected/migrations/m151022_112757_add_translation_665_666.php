<?php

class m151022_112757_add_translation_665_666 extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('sourcemessages', array(
			array(
				'id' => '665',
				'category' => 'lecture',
				'message' => '0665'
			),
			array(
				'id' => '666',
				'category' => 'slider',
				'message' => '0666'
			),
		));

		$this->insertMultiple('messages', array(
			array(
				'id_record' => null,
				'id' => '0665',
				'language' => 'ua',
				'translation' => 'Допомога по скайпу'
			),
			array(
				'id_record' => null,
				'id' => '0665',
				'language' => 'ru',
				'translation' => 'Помощь по скайпу'
			),
			array(
				'id_record' => null,
				'id' => '0665',
				'language' => 'en',
				'translation' => 'Assistance on Skype'
			),
			array(
				'id_record' => null,
				'id' => '0666',
				'language' => 'ua',
				'translation' => 'В майбутньому буде два типи робіт: ті - де Ви вказуватимете комп\'ютеру що робити - програмувати і ті - де машини вказуватимуть що робити Вам!'
			),
			array(
				'id_record' => null,
				'id' => '0666',
				'language' => 'ru',
				'translation' => 'В будущем будет два типа работ: те - где Вы указывать цель компьютеру что делать - программировать и те - где машины будут указывать что делать Вам!'
			),
			array(
				'id_record' => null,
				'id' => '0666',
				'language' => 'en',
				'translation' => 'In the future there’s potentially two types of jobs: where you tell a machine what to do, programming a computer, or a machine is going to tell you what to do!'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('messages', 'id=665');
		$this->delete('sourcemessages', 'id=665');
		$this->delete('messages', 'id=666');
		$this->delete('sourcemessages', 'id=666');
	}
}