<?php

class m170720_211707_alter_column_bank_code extends CDbMigration
{
    public function safeUp()
    {
        $this->alterColumn('acc_checking_accounts', 'bank_code', 'VARCHAR(64) NOT NULL');
    }

    public function safeDown()
    {
        $this->alterColumn('acc_checking_accounts', 'bank_code', 'INT NOT NULL');
    }

}