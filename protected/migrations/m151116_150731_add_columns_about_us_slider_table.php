<?php

class m151116_150731_add_columns_about_us_slider_table extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $this->addColumn('aboutus_slider','text','VARCHAR(5) NOT NULL');
        $this->addColumn('aboutus_slider','order','INT NOT NULL');
    }

	public function safeDown()
	{
	    $this->dropColumn('aboutus_slider', 'id');
        $this->dropColumn('aboutus_slider', 'text');
	}

}