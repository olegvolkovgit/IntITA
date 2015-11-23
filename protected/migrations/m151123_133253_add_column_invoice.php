<?php

class m151123_133253_add_column_invoice extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m151123_133253_add_column_invoice does not support migration down.\n";
//		return false;
//	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('acc_invoice','number','VARCHAR(50)');

    }

	public function safeDown()
	{
        $this->dropColumn('acc_invoice','number');
	}

}