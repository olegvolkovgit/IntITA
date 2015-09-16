<?php

class m150916_165636_add_translate_column_graduate_page extends CDbMigration
{
	public function up()
	{
        $this->addColumn('graduate', 'first_name_en', 'VARCHAR(50) NULL');
        $this->addColumn('graduate', 'last_name_en', 'VARCHAR(50) NULL');
	}

	public function down()
	{
        $this->dropColumn('graduate', 'first_name_en');
        $this->dropColumn('graduate', 'last_name_en');
	}
}