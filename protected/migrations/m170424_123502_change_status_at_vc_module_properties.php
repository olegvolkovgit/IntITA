<?php

class m170424_123502_change_status_at_vc_module_properties extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('vc_module_properties', 'status_offline', 'TINYINT(4) NOT NULL DEFAULT 0');
        $this->renameColumn ('vc_module_properties', 'status', 'status_online');

        $this->dropColumn('vc_module_properties', 'price_offline');
        $this->dropColumn('module', 'price_offline');
        $this->dropColumn('module', 'lesson_count');
    }

    public function safeDown()
    {
        $this->addColumn('module', 'lesson_count', 'INT(10) DEFAULT NULL');
        $this->addColumn('vc_module_properties', 'price_offline', 'DECIMAL(10)');
        $this->addColumn('module', 'price_offline', 'DECIMAL(10)');

        $this->dropColumn('vc_module_properties', 'status_offline');
        $this->renameColumn ('vc_module_properties', 'status_online', 'status');
    }
}