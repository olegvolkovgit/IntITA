<?php

class m171216_123636_add_expected_time_column_to_crm_tasks_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('crm_tasks', 'expected_time', 'DECIMAL(10,1) DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('crm_tasks', 'expected_time');
    }
}