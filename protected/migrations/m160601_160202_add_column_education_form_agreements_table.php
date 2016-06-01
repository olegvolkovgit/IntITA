<?php

class m160601_160202_add_column_education_form_agreements_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('acc_user_agreements', 'educForm', 'INT(11) NOT NULL DEFAULT 1');
	}

	public function down()
	{
		echo "m160601_160202_add_column_education_form_agreements_table does not support migration down.\n";
		return false;
	}
}