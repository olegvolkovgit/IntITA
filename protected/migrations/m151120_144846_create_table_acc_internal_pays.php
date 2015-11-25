<?php

class m151120_144846_create_table_acc_internal_pays extends CDbMigration
{
    public function up()
    {
        $this->createTable('acc_internal_pays', array(
            'id' => 'pk',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "create date"',
            'create_user' => 'INT(11) NOT NULL COMMENT "User who create"',
            'invoice_id' => 'INT(11) NOT NULL COMMENT "Invoice"',
            'description' => 'VARCHAR(512) NOT NULL DEFAULT "Pay"',
            'summa' => 'DECIMAL(10,2) NOT NULL COMMENT "Payment summ"',
            'INDEX `acc_user_id` (`invoice_id`)',
            'INDEX `create_user` (`create_user`)',
            'INDEX `service_id` (`invoice_id`)',
            'CONSTRAINT `FK_acc_internal_pays_acc_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `acc_invoice` (`id`)'
        ));
    }

    public function down()
    {
        $this->dropForeignKey('FK_acc_internal_pays_acc_invoice', 'acc_internal_pays');
        $this->dropTable('acc_internal_pays');
    }
}