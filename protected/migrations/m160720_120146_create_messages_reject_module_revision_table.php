<?php

class m160720_120146_create_messages_reject_module_revision_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_reject_module_revision', array(
			'id_message' => 'INT NOT NULL',
			'id_revision' => 'INT(10) NOT NULL',
			'comment' => 'TEXT NOT NULL',
			'PRIMARY KEY (`id_message`)',
			'INDEX `FK_messages_reject_revision_vc_module` (`id_revision`)',
			'CONSTRAINT `FK_messages_reject_module_revision_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
			'CONSTRAINT `FK_messages_reject_revision_vc_module` FOREIGN KEY (`id_revision`) REFERENCES `vc_module` (`id_module_revision`)'
		),
			'COMMENT=\'Message to module revision\\\'s author for successful rejecting revision . \'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);
		$this->insert('messages_type', array(
			'id' => '12',
			'type' => 'reject_module_revision',
			'description' => 'Message to module revision\\\'s author for successful rejecting revision.'
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_messages_reject_module_revision_messages', 'messages_reject_module_revision');
		$this->dropForeignKey('FK_messages_reject_revision_vc_module', 'messages_reject_module_revision');
		$this->dropTable('messages_reject_module_revision');
	}
}