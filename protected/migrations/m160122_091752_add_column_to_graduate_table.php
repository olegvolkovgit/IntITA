<?php

class m160122_091752_add_column_to_graduate_table extends CDbMigration
{

	public function safeUp()
	{
        $this->addColumn('graduate','first_name_ru','string NOT NULL DEFAULT "не указано"');
        $this->addColumn('graduate','last_name_ru','string NOT NULL DEFAULT "не указано"');
	}

	public function safeDown()
	{
        $this->dropColumn('graduate','first_name_ru');
        $this->dropColumn('graduate','last_name_ru');
	}

}