<?php

class m160407_085548_add_text_position_column_about_us_slider extends CDbMigration
{
	public function up()
	{
		$this->addColumn('aboutus_slider', 'left', 'INT(3) DEFAULT 50');
		$this->addColumn('aboutus_slider', 'top', 'INT(3) DEFAULT 10');
		$this->addColumn('aboutus_slider', 'text_color', 'string DEFAULT "#000000"');
	}

	public function down()
	{
		$this->dropColumn('aboutus_slider', 'left');
		$this->dropColumn('aboutus_slider', 'top');
		$this->dropColumn('aboutus_slider', 'text_color');
	}
}