<?php

class m171016_144045_create_table_acc_user_written_agreement extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('acc_user_written_agreement', array(
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'id_user' => 'INT(11) NOT NULL',
            'id_agreement' => 'INT NOT NULL',
            'template_html'=> 'TEXT DEFAULT NULL',
            'checked_by_user' => 'BOOLEAN NOT NULL DEFAULT FALSE',
            'checked' => 'BOOLEAN NOT NULL DEFAULT FALSE',
            'checked_by' => 'INT(11) DEFAULT NULL',
            'updatedAt' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'actual' => 'BOOLEAN NOT NULL DEFAULT TRUE',
            'checked_date' => 'DATETIME DEFAULT NULL',
            'UNIQUE KEY UC_user_documents_type_actual (`id_user`, `id_agreement`, `actual`)'
        ));

        $this->addForeignKey('FK_user_written_agreement_user', 'acc_user_written_agreement', 'id_user', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_user_written_agreement_agreement', 'acc_user_written_agreement', 'id_agreement', 'acc_user_agreements', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user_written_agreement_agreement', 'acc_user_written_agreement');
        $this->dropForeignKey('FK_user_written_agreement_user', 'acc_user_written_agreement');

        $this->dropTable('acc_user_written_agreement');
    }
}