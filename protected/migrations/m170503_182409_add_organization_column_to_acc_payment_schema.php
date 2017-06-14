<?php

class m170503_182409_add_organization_column_to_acc_payment_schema extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_payment_schema', 'id_organization', 'INT(10) DEFAULT NULL');
        $this->addForeignKey('FK_acc_payment_schema_organization', 'acc_payment_schema', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
        $this->addColumn('acc_payment_schema', 'id_user_approved', 'INT(10) NOT NULL');
        $this->update('acc_payment_schema', array('id_user_approved' => 38));
        $this->addColumn('acc_payment_schema', 'approved_date', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addForeignKey('FK_acc_payment_schema_user', 'acc_payment_schema', 'id_user_approved', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_acc_payment_schema_user', 'acc_payment_schema');
        $this->dropColumn('acc_payment_schema', 'approved_date');
        $this->dropColumn('acc_payment_schema', 'id_organization');
        $this->dropForeignKey('FK_acc_payment_schema_organization', 'acc_payment_schema');
        $this->dropColumn('acc_payment_schema', 'id_organization');
    }
}