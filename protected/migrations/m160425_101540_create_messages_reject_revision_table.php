<?php

class m160425_101540_create_messages_reject_revision_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_reject_revision', array(
			'id_message' => 'INT NOT NULL',
			'id_revision' => 'INT(10) NOT NULL',
			'comment' => 'TEXT NOT NULL',
			'PRIMARY KEY (`id_message`)',
			'INDEX `FK_messages_reject_revision_vc_lecture` (`id_revision`)',
			'CONSTRAINT `FK_messages_reject_revision_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
			'CONSTRAINT `FK_messages_reject_revision_vc_lecture` FOREIGN KEY (`id_revision`) REFERENCES `vc_lecture` (`id_revision`)'
		),
			'COMMENT=\'Message to revision\\\'s author for successful rejecting revision . \'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);
		$this->insert('messages_type', array(
			'id' => '7',
			'type' => 'reject_revision',
			'description' => 'Message to revision\\\'s author for successful rejecting revision.'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_messages_reject_revision_messages', 'messages_reject_revision');
		$this->dropForeignKey('FK_messages_reject_revision_vc_lecture', 'messages_reject_revision');
		$this->dropTable('messages_reject_revision');
	}
}