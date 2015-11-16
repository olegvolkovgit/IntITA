<?php

class m151116_131923_add_column_carousel_table extends CDbMigration
{
	public function safeUp()
	{
        $this->dropPrimaryKey('order','carousel');
        $this->addColumn('carousel','id','pk');
	}

	public function safeDown()
	{
       $this->dropColumn('carousel', 'id');
	}
}