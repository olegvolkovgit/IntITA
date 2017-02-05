<?php

class m161223_154108_alter_column_startdate_at_payment_schema_table extends CDbMigration
{
	public function safeUp()
	{
		$this->alterColumn('acc_payment_schema', 'startDate', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
	}

	public function safeDown()
	{
		echo "m161223_154108_alter_column_startdate_at_payment_schema_table does not support migration down.\n";
		return false;
	}
}