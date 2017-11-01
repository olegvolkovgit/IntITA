<?php

class m171014_181412_add_column_to_corporate_entity_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_corporate_entity', 'license_number', 'VARCHAR(256) DEFAULT NULL');
        $this->addColumn('acc_corporate_entity', 'license_issued', 'VARCHAR(256) DEFAULT NULL');
        $this->addColumn('acc_corporate_entity', 'license_issued_date', 'DATE DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('acc_corporate_entity', 'license_number');
        $this->dropColumn('acc_corporate_entity', 'license_issued');
        $this->dropColumn('acc_corporate_entity', 'license_issued_date');
    }
}