<?php

class m170522_190129_create_table_acc_checking_accounts extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('acc_checking_accounts', array(
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'bank_name' => 'VARCHAR(255) NOT NULL',
            'bank_code' => 'INT NOT NULL',
            'checking_account' => 'bigint NOT NULL',
            'checking_account_order' => 'INT(2) NOT NULL',
            'corporate_entity' => 'INT(10) NOT NULL',
            'createdAt' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'deletedAt' => 'DATETIME DEFAULT \'9999-12-31 23:59:59\' ',
            'INDEX `FK_checking_accounts_corporate_entity` (`corporate_entity`)',
            'CONSTRAINT `FK_checking_accounts_corporate_entity` FOREIGN KEY (`corporate_entity`) REFERENCES `acc_corporate_entity` (`id`)',
        ));

        $this->insert('acc_checking_accounts', array(
            'id' => '1',
            'bank_name' => 'АТ «ОТП Банк»',
            'bank_code' => 300528,
            'checking_account' => 26005001352431,
            'checking_account_order' => 1,
            'corporate_entity' => 1,
        ));
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_checking_accounts_corporate_entity', 'acc_checking_accounts');
        $this->dropTable('acc_checking_accounts');
	}
}