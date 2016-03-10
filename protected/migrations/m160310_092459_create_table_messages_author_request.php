<?php

class m160310_092459_create_table_messages_author_request extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_author_request', array(
            'id_message' => 'INT NOT NULL',
			'id_module' => 'INT(10) NOT NULL',
			'date_approved' => 'DATETIME NULL',
			'user_approved' => 'INT(10) NULL',
			'INDEX `FK_messages_author_request_module` (`id_module`)',
			'INDEX `FK_messages_author_request_user_2` (`user_approved`)',
			'CONSTRAINT `FK_messages_author_request_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`module_ID`)',
			'CONSTRAINT `FK_messages_author_request_user_2` FOREIGN KEY (`user_approved`) REFERENCES `user` (`id`)',
            'CONSTRAINT `FK_messages_author_request_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)'
		),
			'COMMENT=\'Teacher requests about editing modules(to admins).\'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);
		$this->insert('messages_type', array(
			'id' => '3',
			'type' => 'author_request',
			'description' => 'Teacher\'s request about editing module'
		));
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_messages_author_request_module', 'messages_author_request');
        $this->dropForeignKey('FK_messages_author_request_user_2', 'messages_author_request');
        $this->dropForeignKey('FK_messages_author_request_messages', 'messages_author_request');
		$this->dropTable('messages_author_request');
	}
}