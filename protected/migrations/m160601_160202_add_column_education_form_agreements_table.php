<?php

class m160601_160202_add_column_education_form_agreements_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('acc_service', 'education_form', 'INT(11) NOT NULL DEFAULT 1');
	}

	public function down()
	{
		$this->dropColumn('acc_service', 'education_form');
	}
}