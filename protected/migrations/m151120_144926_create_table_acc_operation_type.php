<?php

class m151120_144926_create_table_acc_operation_type extends CDbMigration
{
    public function up()
    {
        $this->createTable('acc_operation_type', array(
            'id' => 'pk',
            'description' => 'VARCHAR(50) NULL DEFAULT NULL',
            'negative_summa' => 'TINYINT(1) NOT NULL DEFAULT "0"',
        ), "COLLATE='utf8_general_ci' ENGINE=InnoDB;"
        );
    }

    public function safeDown()
    {
        $this->dropTable('acc_operation_type');
    }
}