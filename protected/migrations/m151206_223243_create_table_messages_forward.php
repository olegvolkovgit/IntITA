<?php

class m151206_223243_create_table_messages_forward extends CDbMigration
{
    public function up()
    {
        $this->createTable('messages_forward', array(
            'id_message' => 'INT(10) NOT NULL',
            'forward' => 'INT(10) NOT NULL',
            'CONSTRAINT `FK_messages_forward_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
            'CONSTRAINT `FK_messages_forward_messages_2` FOREIGN KEY (`forward`) REFERENCES `messages` (`id`)'
        ));
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_messages_forward_messages', 'messages_forward');
        $this->dropForeignKey('FK_messages_forward_messages_2', 'messages_forward');
        $this->dropTable('messages_forward');
    }
}