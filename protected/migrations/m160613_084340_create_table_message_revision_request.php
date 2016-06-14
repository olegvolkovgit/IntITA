<?php

class m160613_084340_create_table_message_revision_request extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_revision_request', array(
			'id_message' => 'INT NOT NULL',
			'id_revision' => 'INT(10) NOT NULL',
			'date_approved' => 'DATETIME NULL',
			'user_approved' => 'INT(10) NULL',
			'cancelled' => 'TINYINT(1) NOT NULL DEFAULT \'0\' COMMENT \'0 - actual, 1 - cancelled\'',
			'CONSTRAINT `FK_messages_revision_request_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
			'CONSTRAINT `FK_messages_revision_request_vc_lecture` FOREIGN KEY (`id_revision`) REFERENCES `vc_lecture` (`id_revision`)',
			'CONSTRAINT `FK_messages_revision_request_user` FOREIGN KEY (`user_approved`) REFERENCES `user` (`id`)'
		),
			'COMMENT=\'	Author requests about approve revision (to admins).\'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);
		$this->insert('messages_type', array(
			'id' => '10',
			'type' => 'revision_request',
			'description' => 'Author requests about approve revision'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_messages_revision_request_messages', 'messages_revision_request');
		$this->dropForeignKey('FK_messages_revision_request_user', 'messages_revision_request');
		$this->dropForeignKey('FK_messages_revision_request_vc_lecture', 'messages_revision_request');
		$this->dropTable('messages_revision_request');
	}
}