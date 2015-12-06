<?php

class m151206_174047_create_table_messages extends CDbMigration
{
	public function up()
	{
        $this->createTable('messages', array(
            'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'sender' => 'INT(10) NOT NULL',
            'type' => 'INT(10) NOT NULL',
            'draft' => 'INT(10) NOT NULL',
            'chained_message_id' => 'INT(10) NULL DEFAULT NULL',
            'original_message_id' => 'INT(10) NULL DEFAULT NULL',
            'PRIMARY KEY (`id`)',
            'INDEX `FK_messages_messages_type` (`type`)',
            'INDEX `FK_messages_user` (`sender`)',
            'CONSTRAINT `FK_messages_messages_type` FOREIGN KEY (`type`) REFERENCES `messages_type` (`id`)',
            'CONSTRAINT `FK_messages_user` FOREIGN KEY (`sender`) REFERENCES `user` (`id`)'
        ));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_messages_messages_type', 'messages');
        $this->dropForeignKey('FK_messages_user', 'messages');
        $this->dropTable('messages');
	}
}