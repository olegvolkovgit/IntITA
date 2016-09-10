<?php

class m160910_081920_alter_internal_payment_table extends CDbMigration
{
	public function up() {
        $this->addColumn('acc_internal_pays', 'externalPaymentId', 'INT NOT NULL');
        $this->dropColumn('acc_internal_pays', 'description');
        $this->addForeignKey('FK_internal_pays_invoice', 'acc_internal_pays', 'invoice_id', 'acc_invoice', 'id');
	}

	public function down()
	{
        $this->dropColumn('acc_internal_pays', 'externalPaymentId');
        $this->addColumn('acc_internal_pays', 'description', 'VARCHAR(255)');
        $this->dropForeignKey('FK_internal_pays_invoice', 'acc_internal_pays');
	}

}