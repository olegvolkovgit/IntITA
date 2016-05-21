<?php

class m160516_110321_create_table_messages_notifications extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_notifications', array(
			'id_message' => 'INT(10) NOT NULL',
			'subject' => 'VARCHAR(255) NOT NULL',
			'text' => 'TEXT NOT NULL',
			'INDEX `FK_messages_notifications_messages` (`id_message`)',
			'CONSTRAINT `FK_messages_notifications_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)'
		));

		$this->insert('messages_type', array(
			'id' => '9',
			'type' => 'notification',
			'description' => 'User notifications'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_user_messages_messages', 'messages_notifications');
		$this->dropTable('messages_notifications');
	}
}