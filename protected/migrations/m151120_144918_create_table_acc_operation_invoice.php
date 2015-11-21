<?php

class m151120_144918_create_table_acc_operation_invoice extends CDbMigration
{
    public function up()
    {
        $this->createTable('acc_operation_invoice', array(
            'id_operation' => 'INT(10) NOT NULL',
            'id_invoice' => 'INT(10) NOT NULL',
            'CONSTRAINT `FK_acc_operation_invoice_acc_operation` FOREIGN KEY (`id_operation`) REFERENCES `acc_operation` (`id`)',
            'CONSTRAINT `FK_acc_operation_invoice_acc_invoice` FOREIGN KEY (`id_invoice`) REFERENCES `acc_invoice` (`id`)'
        ), "COLLATE='utf8_general_ci' ENGINE=InnoDB;"
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_acc_operation_invoice_acc_operation', 'acc_operation_invoice');
        $this->dropForeignKey('FK_acc_operation_invoice_acc_invoice', 'acc_operation_invoice');
        $this->dropTable('acc_operation_invoice');
    }
}