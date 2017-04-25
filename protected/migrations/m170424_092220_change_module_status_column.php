<?php

class m170424_092220_change_module_status_column extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('module', 'status_offline', 'TINYINT(4) NOT NULL DEFAULT 0');
        $this->renameColumn ('module', 'status', 'status_online');
    }

    public function safeDown()
    {
        $this->dropColumn('module', 'status_offline');
        $this->renameColumn ('module', 'status_online', 'status');
    }
}