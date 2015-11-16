<?php

class m151116_131923_add_column_carousel_table extends CDbMigration
{
	public function up()
	{
        $this->dropPrimaryKey('order','carousel');
        $this->addColumn('carousel','id','INT DEFAULT NULL');
        $this->addPrimaryKey('id', 'carousel', 'id');
	}

	public function down()
	{
        $this->dropColumn('carousel', 'id');
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