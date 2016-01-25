<?php

class m151206_174107_create_table_message_receiver extends CDbMigration
{
	public function up()
	{
        $this->createTable('message_receiver', array(
            'id_message' => 'INT(10) NOT NULL',
            'id_receiver' => 'INT(10) NOT NULL',
            'read' => 'DATETIME NULL DEFAULT NULL',
            'deleted' => 'DATETIME NULL DEFAULT NULL',
            'PRIMARY KEY (`id_message`, `id_receiver`)',
            'INDEX `FK_message_receiver_user` (`id_receiver`)',
            'CONSTRAINT `FK_message_receiver_messages_3` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
            'CONSTRAINT `FK_message_receiver_user` FOREIGN KEY (`id_receiver`) REFERENCES `user` (`id`)'
        ));
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_message_receiver_messages_3', 'message_receiver');
        $this->dropForeignKey('FK_message_receiver_user', 'message_receiver');
        $this->dropTable('message_receiver');
	}
}