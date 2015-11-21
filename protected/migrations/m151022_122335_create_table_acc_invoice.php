<?php

class m151022_122335_create_table_acc_invoice extends CDbMigration
{
	public function up()
	{
        $this->createTable('acc_invoice', array(
            'id' => 'pk',
            'agreement_id' => 'INT(10) NOT NULL',
            'date_created' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'date_cancelled' => 'DATETIME NOT NULL',
            'summa' => 'DECIMAL(10,2) NOT NULL DEFAULT `0.00`',
            'payment_date' => 'DATETIME NULL',
            'user_created' => 'INT(11) NOT NULL DEFAULT `0`',
            'expiration_date' => 'DATETIME NULL DEFAULT NULL',
            'user_cancelled' => 'INT(11) NULL DEFAULT NULL',
            'pay_date' => 'DATETIME NULL DEFAULT NULL COMMENT `Date when invoice pay`',
            'INDEX `FK_acc_invoice_acc_user_agreements` (`agreement_id`)',
            'INDEX `FK_acc_invoice_user` (`user_created`)',
            'INDEX `FK_acc_invoice_user_2` (`user_cancelled`)',
            'CONSTRAINT `FK_acc_invoice_acc_user_agreements` FOREIGN KEY (`agreement_id`) REFERENCES `acc_user_agreements` (`id`)',
            'CONSTRAINT `FK_acc_invoice_user` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`)',
            'CONSTRAINT `FK_acc_invoice_user_2` FOREIGN KEY (`user_cancelled`) REFERENCES `user` (`id`)'
        ), "COLLATE='utf8_general_ci' ENGINE=InnoDB");
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_acc_invoice_acc_user_agreements','acc_invoice');
        $this->dropForeignKey('FK_acc_invoice_user', 'acc_invoice');
        $this->dropForeignKey('FK_acc_invoice_user_2', 'acc_invoice');
		$this->dropTable('acc_invoice');
	}
}