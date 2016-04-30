<?php

class m160425_101524_create_messages_approve_revision_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_approve_revision', array(
			'id_message' => 'INT NOT NULL',
			'id_revision' => 'INT(10) NOT NULL',
			'PRIMARY KEY (`id_message`)',
			'INDEX `FK_messages_approve_revision_vc_lecture` (`id_revision`)',
			'CONSTRAINT `FK_messages_approve_revision_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
			'CONSTRAINT `FK_messages_approve_revision_vc_lecture` FOREIGN KEY (`id_revision`) REFERENCES `vc_lecture` (`id_revision`)'
		),
			'COMMENT=\'Message to revision\\\'s author for successful approving revision . \'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);
		$this->insert('messages_type', array(
			'id' => '6',
			'type' => 'approve_revision',
			'description' => 'Message to revision\\\'s author for successful approving revision.'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_messages_approve_revision_messages', 'messages_approve_revision');
		$this->dropForeignKey('FK_messages_approve_revision_vc_lecture', 'messages_approve_revision');
		$this->dropTable('messages_approve_revision');
	}
}