<?php

class m160907_164251_alter_external_payment_table extends CDbMigration
{
	public function up() {
        $this->addColumn('acc_external_pays', 'companyId', "INT NOT NULL");
	}

	public function down()
	{
        $this->dropColumn('acc_external_pays', 'companyId');
		return true;
	}

}