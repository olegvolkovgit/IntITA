<?php

class m160415_115430_add_column_messages_payment extends CDbMigration
{
	public function up()
	{
		$this->addColumn('messages_payment', 'service_id', 'INT(10) NULL DEFAULT NULL');
		$this->addForeignKey('FK_messages_payment_acc_service', 'messages_payment', 'service_id', 'acc_service', 'service_id');
	}

	public function down()
	{
		echo "m160415_115430_add_column_messages_payment does not support migration down.\n";
		return false;
	}
}