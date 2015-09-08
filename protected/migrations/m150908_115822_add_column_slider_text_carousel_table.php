<?php

class m150908_115822_add_column_slider_text_carousel_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('carousel', 'slider_text', 'VARCHAR(6) NOT NULL');
        Carousel::model()->updateByPk(1, array('slider_text' => "0027"));
        Carousel::model()->updateByPk(2, array('slider_text' => "0028"));
        Carousel::model()->updateByPk(3, array('slider_text' => "0029"));
        Carousel::model()->updateByPk(4, array('slider_text' => "0030"));
        Carousel::model()->updateByPk(5, array('slider_text' => "0559"));
        Carousel::model()->updateByPk(6, array('slider_text' => "0560"));

	}

	public function down()
	{
        $this->dropColumn('carousel', 'slider_text');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}