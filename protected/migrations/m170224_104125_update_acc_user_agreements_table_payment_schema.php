<?php

class m170224_104125_update_acc_user_agreements_table_payment_schema extends CDbMigration
{
	public function up()
	{
		$this->update('acc_user_agreements', array('payment_schema' => 12), 'payment_schema=:value', array(':value'=>4));
		$this->update('acc_user_agreements', array('payment_schema' => 4), 'payment_schema=:value', array(':value'=>3));
		$this->update('acc_user_agreements', array('payment_schema' => 3), 'payment_schema=:value', array(':value'=>9));
		$this->update('acc_user_agreements', array('payment_schema' => 36), 'payment_schema=:value', array(':value'=>6));
		$this->update('acc_user_agreements', array('payment_schema' => 6), 'payment_schema=:value', array(':value'=>10));
		$this->update('acc_user_agreements', array('payment_schema' => 24), 'payment_schema=:value', array(':value'=>5));
		$this->update('acc_user_agreements', array('payment_schema' => 48), 'payment_schema=:value', array(':value'=>7));
		$this->update('acc_user_agreements', array('payment_schema' => 60), 'payment_schema=:value', array(':value'=>8));
	}

	public function down()
	{
		echo "m170224_104125_update_acc_user_agreements_table_payment_schema does not support migration down.\n";
		return false;
	}
}