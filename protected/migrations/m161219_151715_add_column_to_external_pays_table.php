<?php

class m161219_151715_add_column_to_external_pays_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('acc_external_pays', 'payerName', 'VARCHAR(255) NULL DEFAULT NULL');
		$this->addColumn('acc_external_pays', 'payerId', 'VARCHAR(255) NULL DEFAULT NULL');
	}

	public function safeDown()
	{
		$this->dropColumn('acc_external_pays', 'payerName');
		$this->dropColumn('identification', 'payerId');
	}
}