<?php

class m180105_113514_add_changed_by_to_crm_tasks extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('crm_tasks', 'changed_by', 'INT(10) DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('crm_tasks', 'changed_by');
    }
}