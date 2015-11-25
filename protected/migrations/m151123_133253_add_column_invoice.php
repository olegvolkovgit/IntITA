<?php

class m151123_133253_add_column_invoice extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('acc_invoice','number','VARCHAR(50)');

    }

	public function safeDown()
	{
        $this->dropColumn('acc_invoice','number');
	}

}