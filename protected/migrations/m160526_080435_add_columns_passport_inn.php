<?php

class m160526_080435_add_columns_passport_inn extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn("user", "passport", "VARCHAR(30) NULL DEFAULT NULL");
        $this->addColumn("acc_user_agreements", "passport", "VARCHAR(30) NULL DEFAULT NULL");

        $this->addColumn("user", "document_type", "VARCHAR(30) DEFAULT \"passport\"");
        $this->addColumn("acc_user_agreements", "document_type", "VARCHAR(30) DEFAULT \"passport\"");

        $this->addColumn("user", "document_issued_date", "DATETIME NULL DEFAULT NULL");
        $this->addColumn("acc_user_agreements", "document_issued_date", "DATETIME NULL DEFAULT NULL");

        $this->addColumn("user", "inn", "VARCHAR(30) NULL DEFAULT NULL");
        $this->addColumn("acc_user_agreements", "inn", "VARCHAR(30) NULL DEFAULT NULL");

        $this->addColumn("user", "passport_issued", "VARCHAR(255) NULL DEFAULT NULL");
        $this->addColumn("acc_user_agreements", "passport_issued", "VARCHAR(255) NULL DEFAULT NULL");
	}

	public function down()
	{
		$this->dropColumn('user', 'passport');
        $this->dropColumn('user', 'inn');
        $this->dropColumn('user', 'passport_issued');
        $this->dropColumn('user', 'document_type');
        $this->dropColumn('user', 'document_issued_date');

        $this->dropColumn('acc_user_agreements', 'passport');
        $this->dropColumn('acc_user_agreements', 'inn');
        $this->dropColumn('acc_user_agreements', 'passport_issued');
        $this->dropColumn('acc_user_agreements', 'document_type');
        $this->dropColumn('acc_user_agreements', 'document_issued_date');
	}
}