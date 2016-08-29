<?php

class m160824_073301_alter_external_payment_table extends CDbMigration
{
	public function up() {

        $this->addColumn('acc_external_pays', 'documentNumber', "VARCHAR(100) NOT NULL DEFAULT 'без номеру'");
        $this->addColumn('acc_external_pays', 'comment', "VARCHAR(255)");

        $this->renameColumn('acc_external_pays', 'create_date', 'createDate');
        $this->renameColumn('acc_external_pays', 'create_user', 'createUser');
        $this->renameColumn('acc_external_pays', 'user_id', 'userId');

        $this->renameColumn('acc_external_pays', 'source_id', 'sourceId');
        $this->renameColumn('acc_external_pays', 'pay_date', 'documentDate');
        $this->renameColumn('acc_external_pays', 'summa', 'amount');
        $this->renameColumn('acc_external_pays', 'description', 'documentPurpose');

        $this->alterColumn('acc_external_pays', 'sourceId', 'INT(11) NOT NULL');

        $this->addForeignKey('FK_external_pays_external_sources', 'acc_external_pays', 'sourceId', 'acc_external_sources', 'id', 'RESTRICT', 'RESTRICT');
	}

	public function down() {
        $this->dropForeignKey('FK_external_pays_external_sources', 'acc_external_pays');

        $this->dropColumn('acc_external_pays', 'documentNumber');
        $this->dropColumn('acc_external_pays', 'comment');

        $this->renameColumn('acc_external_pays', 'createDate', 'create_date');
        $this->renameColumn('acc_external_pays', 'createUser', 'create_user');
        $this->renameColumn('acc_external_pays', 'userId', 'user_id');

        $this->renameColumn('acc_external_pays', 'sourceId', 'source_id');
        $this->renameColumn('acc_external_pays', 'documentDate', 'pay_date');
        $this->renameColumn('acc_external_pays', 'amount', 'summa');
        $this->renameColumn('acc_external_pays', 'documentPurpose', 'description');

	}

}