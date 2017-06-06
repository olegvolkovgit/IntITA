<?php

class m170606_131114_add_column_to_offline_groups extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('offline_subgroups', 'journal', 'TEXT DEFAULT NULL');
        $this->addColumn('offline_subgroups', 'link', 'TEXT DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('offline_subgroups', 'journal');
        $this->dropColumn('offline_subgroups', 'link');
    }
}