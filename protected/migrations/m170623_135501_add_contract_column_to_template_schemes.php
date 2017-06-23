<?php

class m170623_135501_add_contract_column_to_template_schemes extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_template_schemas', 'contract', 'BOOLEAN NOT NULL DEFAULT FALSE');
    }

    public function safeDown()
    {
        $this->dropColumn('acc_template_schemas', 'contract');
    }
}