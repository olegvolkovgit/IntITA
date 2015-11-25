<?php

class m151120_144819_create_table_acc_external_pays extends CDbMigration
{
    public function up()
    {
        $this->createTable('acc_external_pays', array(
            'id' => 'pk',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "Date of creation"',
            'create_user' => 'INT(11) NOT NULL COMMENT "User who created record"',
            'source_id' => 'INT(10) UNSIGNED NOT NULL COMMENT "External source"',
            'user_id' => 'INT(11) NOT NULL COMMENT "User who payed"',
            'pay_date' => 'DATE NOT NULL COMMENT "Date when pay was made"',
            'summa' => 'DECIMAL(10,2) NOT NULL COMMENT "Summa of payment"',
            'description' => 'VARCHAR(512) NOT NULL COMMENT "Description of payment"',
            'INDEX `create_date` (`create_date`, `create_user`, `source_id`, `user_id`, `pay_date`)',
            'INDEX `create_user` (`create_user`)',
            'INDEX `source_id` (`source_id`)',
            'INDEX `user_id` (`user_id`)',
            'INDEX `pay_date` (`pay_date`)',
            'CONSTRAINT `FK_acc_external_pays_acc_external_sources` FOREIGN KEY (`source_id`) REFERENCES `acc_external_sources` (`id`)'
        ));
    }

    public function down()
    {
        $this->dropForeignKey('FK_acc_external_pays_acc_external_sources', 'acc_external_pays');
        $this->dropTable('acc_external_pays');
    }
}