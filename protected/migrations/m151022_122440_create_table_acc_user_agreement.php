<?php

class m151022_122440_create_table_acc_user_agreement extends CDbMigration
{
	public function up()
	{
        $this->createTable('acc_user_agreement', array(
            'id' => 'pk',
            'user_id' => 'INT(11) NOT NULL COMMENT "User which have agreement"',
            'service_id' => 'INT(10) UNSIGNED NOT NULL COMMENT "Service for this agreement"',
            'summa' => 'DECIMAL(10,2) NOT NULL DEFAULT "0.00" COMMENT "Cost of agreement"',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'number' => 'VARCHAR(50) NULL DEFAULT "без номеру"',
            'approval_user' => 'INT(11) NULL DEFAULT NULL COMMENT "user who underscribe agreement"',
            'approval_date' => 'DATETIME NULL DEFAULT NULL COMMENT "date when agreement was approved"',
            'cancel_user' => 'INT(1) NULL DEFAULT NULL COMMENT "Is agreement cancelled"',
            'cancel_date' => 'DATETIME NULL DEFAULT NULL COMMENT "date when agreement was cancelled"',
            'close_date' => 'DATETIME NULL DEFAULT NULL COMMENT "Date when agreement should be closed"',
            'payment_schema' => 'INT(10) UNSIGNED NOT NULL COMMENT "Payment schema"',
            'cancel_reason_type' => 'INT(10) NULL DEFAULT NULL',
//            'INDEX `user_id` (`user_id`, `service_id`, `approval_user`, `payment_schema`)',
//            'INDEX `service_id` (`service_id`)',
//            'INDEX `approval_user` (`approval_user`)',
//            'INDEX `cancel_user` (`cancel_user`)',
//            'INDEX `cancel_date` (`cancel_date`)',
//            'INDEX `payment_scheme` (`payment_schema`)',
//            'CONSTRAINT `FK_acc_user_agreements_acc_payment_schema` FOREIGN KEY (`payment_scheme`) REFERENCES `acc_payment_schema` (`id`)',
//            'CONSTRAINT `FK_acc_user_agreements_acc_payment_schema` FOREIGN KEY (`payment_schema`) REFERENCES `acc_payment_schema` (`id`)'
        ));
	}

	public function down()
	{
        //TO DO: drop indexes
//        $this->dropForeignKey('FK_acc_user_agreements_acc_payment_schema', 'acc_user_agreement');
		$this->dropTable('acc_user_agreement');
	}
}