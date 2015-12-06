<?php

class m151206_223228_create_table_messages_reply extends CDbMigration
{
	public function up()
	{
        $this->createTable('messages_reply', array(
            'id_message' => 'INT(10) NOT NULL',
            'reply' => 'INT(10) NOT NULL',
            'CONSTRAINT `FK__messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
            'CONSTRAINT `FK__messages_2` FOREIGN KEY (`reply`) REFERENCES `messages` (`id`)'
        ));
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK__messages', 'messages_reply');
        $this->dropForeignKey('FK__messages_2', 'messages_reply');
        $this->dropTable('messages_reply');
	}
}