<?php

class m170104_114835_update_table_specializations_group extends CDbMigration
{

	public function safeUp()
	{
		$this->renameColumn ('specializations_group', 'name', 'title_ua');
		$this->addColumn('specializations_group', 'title_ru', 'VARCHAR(128) NOT NULL');
		$this->addColumn('specializations_group', 'title_en', 'VARCHAR(128) NOT NULL');

		$this->update('specializations_group', array('title_ru'=> new CDbExpression('title_ua')));
		$this->update('specializations_group', array('title_en'=> new CDbExpression('title_ua')));
	}

	public function safeDown()
	{
		$this->renameColumn ('specializations_group', 'title_ua', 'name');
		$this->dropColumn('specializations_group', 'title_ru');
		$this->dropColumn('specializations_group', 'title_en');
	}
	
}