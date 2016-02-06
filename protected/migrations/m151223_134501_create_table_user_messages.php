<?php

class m151223_134501_create_table_user_messages extends CDbMigration
{

	public function safeUp()
	{
		$this->createTable('user_messages', array(
            'id_message' => 'INT(10) NOT NULL',
            'subject' => 'VARCHAR(255) NOT NULL',
            'text' => 'TEXT NOT NULL',
            'INDEX `FK_user_messages_messages` (`id_message`)',
            'CONSTRAINT `FK_user_messages_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)'
        ));
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_user_messages_messages', 'user_messages');
        $this->dropTable('user_messages');
	}
}