<?php

class m150902_173409_add_aboutus_slider_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('aboutus_slider', array(
            'image_order' => 'pk',
            'pictureUrl' => 'VARCHAR(255) NOT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('aboutus_slider');
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