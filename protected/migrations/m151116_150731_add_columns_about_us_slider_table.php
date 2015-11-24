<?php

class m151116_150731_add_columns_about_us_slider_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->truncateTable('aboutus_slider');

        $this->addColumn('aboutus_slider','text','VARCHAR(5) NOT NULL');
        $this->addColumn('aboutus_slider','order','INT NOT NULL');

        $this->insertMultiple('aboutus_slider', array(
            array(
                'pictureUrl' => '1.jpg',
                'text' => '0550',
                'order' => 1
            )));
        $this->insertMultiple('aboutus_slider', array(
            array(
                'pictureUrl' => '2.jpg',
                'text' => '0551',
                'order' => 2
            )));
        $this->insertMultiple('aboutus_slider', array(
            array(
                'pictureUrl' => '3.jpg',
                'text' => '0552',
                'order' => 3
            )));
        $this->insertMultiple('aboutus_slider', array(
            array(
                'pictureUrl' => '4.jpg',
                'text' => '0553',
                'order' => 4
            )));
        $this->insertMultiple('aboutus_slider', array(
            array(
                'pictureUrl' => '5.jpg',
                'text' => '0554',
                'order' => 5
            )));
        $this->insertMultiple('aboutus_slider', array(
            array(
                'pictureUrl' => '6.jpg',
                'text' => '0555',
                'order' => 6
            )));

    }

    public function safeDown()
    {
        $this->truncateTable('aboutus_slider');
        $this->dropColumn('aboutus_slider', 'id');
        $this->dropColumn('aboutus_slider', 'text');

    }

}