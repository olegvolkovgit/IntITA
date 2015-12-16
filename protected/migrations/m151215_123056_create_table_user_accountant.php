<?php

class m151215_123056_create_table_user_accountant extends CDbMigration
{
    public function up()
    {
        $this->createTable('user_accountant', array(
            'id_user' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'end_date' => 'DATETIME NULL DEFAULT NULL',
            'PRIMARY KEY (`id_user`)',
            'CONSTRAINT `FK_user_accountant_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
        ));
    }

    public function down()
    {
        $this->dropForeignKey('FK_user_accountant_user', 'user_admin');
        $this->dropTable('user_accountant');
    }
}