<?php

class m161110_172039_invoice_date_cancelled_nullable extends CDbMigration
{
	public function up() {
        $this->alterColumn('acc_invoice', 'date_cancelled', 'DATETIME NULL DEFAULT NULL');
	}

	public function down()
	{
        $this->alterColumn('acc_invoice', 'date_cancelled', 'DATETIME NOT NULL');
		return true;
	}
}