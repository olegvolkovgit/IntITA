<?php

class m151120_144926_create_table_acc_operation_type extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('acc_operation_type', array(
            'id' => 'pk',
            'description' => 'VARCHAR(50) NULL DEFAULT NULL',
            'negative_summa' => 'TINYINT(1) NOT NULL DEFAULT "0"',
        ), "COLLATE='utf8_general_ci' ENGINE=InnoDB;"
        );
        $this->insertMultiple('acc_operation_type', array(
            array(
                'id' => '1',
                'description' => 'оплата по договору',
                'negative_summa' => '0'
            ),
            array(
                'id' => '2',
                'description' => 'оплата по рахунку',
                'negative_summa' => '0'
            )
        ));
    }

    public function safeDown()
    {
        $this->dropTable('acc_operation_type');
    }
}