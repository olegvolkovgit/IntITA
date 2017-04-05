<?php

class m170330_102527_update_teacher_table_dafault_value extends CDbMigration
{
	public function safeUp()
	{
		$this->alterColumn('teacher', 'profile_text_first', 'TEXT DEFAULT NULL');
		$this->alterColumn('teacher', 'profile_text_short', 'TEXT DEFAULT NULL');
		$this->alterColumn('teacher', 'profile_text_last', 'TEXT DEFAULT NULL');
		$this->alterColumn('teacher', 'first_name_ru', 'VARCHAR(50) DEFAULT NULL');
		$this->alterColumn('teacher', 'middle_name_ru', 'VARCHAR(50) DEFAULT NULL');
		$this->alterColumn('teacher', 'last_name_ru', 'VARCHAR(50) DEFAULT NULL');

		$this->update('teacher', array('first_name_ru' => null), 'first_name_ru=:value', array(':value'=>'не указано'));
		$this->update('teacher', array('middle_name_ru' => null), 'middle_name_ru=:value', array(':value'=>'не указано'));
		$this->update('teacher', array('last_name_ru' => null), 'last_name_ru=:value', array(':value'=>'не указано'));
	}

	public function safeDown()
	{
		$this->update('teacher', array('first_name_ru' => 'не указано'), 'first_name_ru=:value', array(':value'=>null));
		$this->update('teacher', array('middle_name_ru' => 'не указано'), 'middle_name_ru=:value', array(':value'=>null));
		$this->update('teacher', array('last_name_ru' => 'не указано'), 'last_name_ru=:value', array(':value'=>null));
		
		$this->alterColumn('teacher', 'profile_text_first', 'TEXT NOT NULL');
		$this->alterColumn('teacher', 'profile_text_short', 'TEXT NOT NULL');
		$this->alterColumn('teacher', 'profile_text_last', 'TEXT NOT NULL');
		$this->alterColumn('teacher', 'first_name_ru', 'VARCHAR(255) NOT NULL DEFAULT "не указано"');
		$this->alterColumn('teacher', 'middle_name_ru', 'VARCHAR(255) NOT NULL DEFAULT "не указано"');
		$this->alterColumn('teacher', 'last_name_ru', 'VARCHAR(255) NOT NULL DEFAULT "не указано"');
	}
}