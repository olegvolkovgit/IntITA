<?php

class m171011_140432_add_name_to_written_agreement_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_written_agreement_template', 'name', 'VARCHAR(256) NOT NULL');
        $this->update('acc_written_agreement_template', array('name' => 'По замовчуваню'));
    }

    public function safeDown()
    {
        $this->dropColumn('acc_written_agreement_template', 'name');
    }
}