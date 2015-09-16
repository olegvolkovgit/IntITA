<?php

class m150916_132211_add_teacher_name_en_translate_columns extends CDbMigration
{
	public function up()
	{
        $this->addColumn('teacher', 'first_name_en', 'VARCHAR(50) NULL');
        $this->addColumn('teacher', 'middle_name_en', 'VARCHAR(50) NULL');
        $this->addColumn('teacher', 'last_name_en', 'VARCHAR(50) NULL');
	}

	public function down()
	{
        $this->dropColumn('teacher', 'first_name_en');
        $this->dropColumn('teacher', 'middle_name_en');
        $this->dropColumn('teacher', 'last_name_en');
	}
}