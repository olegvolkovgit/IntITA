<?php

class m150908_115822_add_column_slider_text_carousel_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('carousel', 'slider_text', 'VARCHAR(6) NOT NULL');
        $this->update('carousel', array('slider_text' => "0027"), '`order`=1');
        $this->update('carousel', array('slider_text' => "0028"), '`order`=2');
        $this->update('carousel', array('slider_text' => "0029"), '`order`=3');
        $this->update('carousel', array('slider_text' => "0030"), '`order`=4');
        $this->update('carousel', array('slider_text' => "0559"), '`order`=5');
        $this->update('carousel', array('slider_text' => "0560"), '`order`=6');
	}

	public function down()
	{
        $this->dropColumn('carousel', 'slider_text');
	}

}