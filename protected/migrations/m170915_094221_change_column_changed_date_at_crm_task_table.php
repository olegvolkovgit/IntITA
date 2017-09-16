<?php

class m170915_094221_change_column_changed_date_at_crm_task_table extends CDbMigration
{
	public function safeUp()
    {
        $this->alterColumn('crm_tasks', 'change_date', 'DATETIME DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->alterColumn('crm_tasks', 'change_date', 'DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}