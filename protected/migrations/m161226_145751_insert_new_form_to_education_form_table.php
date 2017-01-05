<?php

class m161226_145751_insert_new_form_to_education_form_table extends CDbMigration
{
	public function up()
	{
		$this->insert('education_form', array(
				'id' => '3',
				'title_ua' => 'онлайн/офлайн',
				'title_ru' => 'онлайн/оффлайн',
				'title_en' => 'online/offline',
			)
		);
	}

	public function down()
	{
		echo "m161226_145751_insert_new_form_to_education_form_table does not support migration down.\n";
		return false;
	}
}