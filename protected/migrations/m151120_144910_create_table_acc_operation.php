<?php

class m151120_144910_create_table_acc_operation extends CDbMigration
{
    public function up()
    {
        $this->createTable('acc_operation', array(
            'id' => 'pk',
            'date_create' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'user_create' => 'INT(11) NOT NULL',
            'type_id' => 'INT(11) NOT NULL',
            'summa' =>'DECIMAL(10,2) NOT NULL',
            'INDEX `FK_acc_operation_acc_operation_type` (`type_id`)',
            'CONSTRAINT `FK_acc_operation_acc_operation_type` FOREIGN KEY (`type_id`) REFERENCES `acc_operation_type` (`id`)'
        ));
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_acc_operation_acc_operation_type', 'acc_operation');
        $this->dropTable('acc_operation');
    }
}