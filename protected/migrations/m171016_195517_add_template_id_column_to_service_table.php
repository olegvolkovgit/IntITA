<?php

class m171016_195517_add_template_id_column_to_service_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_service', 'written_agreement_template_id', 'INT(11) NOT NULL DEFAULT 1');
        $this->update('acc_service', array('written_agreement_template_id' => 1));

        $this->addForeignKey('FK_acc_service_agreement_template', 'acc_service', 'written_agreement_template_id', 'acc_written_agreement_template', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_acc_service_agreement_template', 'acc_service');

        $this->dropColumn('acc_service', 'written_agreement_template_id');
    }
}