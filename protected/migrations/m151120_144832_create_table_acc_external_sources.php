<?php

class m151120_144832_create_table_acc_external_sources extends CDbMigration
{
    public function up()
    {
        $this->createTable('acc_external_sources', array(
            'id' => 'pk',
            'name' => 'VARCHAR(512) NOT NULL COMMENT `Name of source`',
            'cash' => 'TINYINT(1) NOT NULL DEFAULT `0` COMMENT `Is cash`',
            'INDEX `cash` (`cash`)'
        ));
    }

    public function down()
    {
        $this->dropTable('acc_external_sources');
    }
}