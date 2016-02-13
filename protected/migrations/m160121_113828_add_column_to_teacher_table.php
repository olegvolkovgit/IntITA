<?php

class m160121_113828_add_column_to_teacher_table extends CDbMigration
{

	public function safeUp()
	{
        $this->addColumn('teacher','first_name_ru','string NOT NULL DEFAULT "не указано"');
        $this->addColumn('teacher','middle_name_ru','string NOT NULL DEFAULT "не указано"');
        $this->addColumn('teacher','last_name_ru','string NOT NULL DEFAULT "не указано"');
	}

	public function safeDown()
	{
        $this->dropColumn('teacher','first_name_ru');
        $this->dropColumn('teacher','middle_name_ru');
        $this->dropColumn('teacher','last_name_ru');
	}

}