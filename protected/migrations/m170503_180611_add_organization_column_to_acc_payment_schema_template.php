<?php

class m170503_180611_add_organization_column_to_acc_payment_schema_template extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_payment_schema_template', 'id_organization', 'INT(10) DEFAULT NULL');
        $this->addForeignKey('FK_acc_payment_schema_template_organization', 'acc_payment_schema_template', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_acc_payment_schema_template_organization', 'acc_payment_schema_template');
        $this->dropColumn('acc_payment_schema_template', 'id_organization');
    }
}