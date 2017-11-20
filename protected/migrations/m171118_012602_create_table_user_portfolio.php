<?php

class m171118_012602_create_table_user_portfolio extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('user_portfolio', array(
            'id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'id_user' => 'INT(10) NOT NULL',
            'file_name' => 'TEXT NOT NULL',
            'upload_time' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'check' => 'BOOLEAN NOT NULL DEFAULT FALSE',
        ));

        $this->addForeignKey('FK_user_portfolio_user', 'user_portfolio', 'id_user', 'user', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('user_portfolio');
    }
}