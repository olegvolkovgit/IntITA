<?php

class m170623_135501_add_contract_column_to_template_schemes extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_template_schemas', 'contract', 'BOOLEAN NOT NULL DEFAULT FALSE');
        $this->addColumn('acc_user_agreements', 'contract', 'BOOLEAN NOT NULL');
        $this->update('acc_user_agreements', array('contract' => '0'));
    }

    public function safeDown()
    {
        $this->dropColumn('acc_template_schemas', 'contract');
        $this->dropColumn('acc_user_agreements', 'contract');
    }
}