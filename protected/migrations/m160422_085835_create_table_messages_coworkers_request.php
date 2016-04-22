<?php

class m160422_085835_create_table_messages_coworkers_request extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_coworker_request', array(
			'id_message' => 'INT NOT NULL',
			'id_teacher' => 'INT(10) NOT NULL',
			'date_approved' => 'DATETIME NULL',
			'user_approved' => 'INT(10) NULL',
			'cancelled' => 'TINYINT(1) NOT NULL DEFAULT \'0\' COMMENT \'0 - actual, 1 - cancelled\'',
			'CONSTRAINT `FK_messages_coworker_request_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
			'CONSTRAINT `FK_messages_coworker_request_user` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`)',
			'CONSTRAINT `FK_messages_coworker_request_user_2` FOREIGN KEY (`user_approved`) REFERENCES `user` (`id`)'
		),
			'COMMENT=\'Content manager requests about assigning coworker(to admins).\'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);
		$this->insert('messages_type', array(
			'id' => '5',
			'type' => 'coworker_request',
			'description' => 'Content manager\'s request about assign coworker'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_messages_coworker_request_messages', 'messages_coworker_request');
		$this->dropForeignKey('FK_messages_coworker_request_user', 'messages_coworker_request');
		$this->dropForeignKey('FK_messages_coworker_request_user_2', 'messages_coworker_request');
		$this->dropTable('messages_coworker_request');
	}
}