<?php

class m160702_110119_create_table_message_module_revision_request extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_module_revision_request', array(
			'id_message' => 'INT NOT NULL',
			'id_module_revision' => 'INT(10) NOT NULL',
			'date_approved' => 'DATETIME NULL',
			'user_approved' => 'INT(10) NULL',
			'cancelled' => 'TINYINT(1) NOT NULL DEFAULT \'0\' COMMENT \'0 - actual, 1 - cancelled\'',
			'CONSTRAINT `FK_messages_module_revision_request_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
			'CONSTRAINT `FK_messages_module_revision_request_vc_module` FOREIGN KEY (`id_module_revision`) REFERENCES `vc_module` (`id_module_revision`)',
			'CONSTRAINT `FK_messages_module_revision_request_user` FOREIGN KEY (`user_approved`) REFERENCES `user` (`id`)'
		),
			'COMMENT=\'	Author requests about approve module revision (to admins).\'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);

		$this->insert('messages_type', array(
			'id' => '11',
			'type' => 'module_revision_request',
			'description' => 'Author requests about approve module revision'
		));
		
		$sqlRevisionRequest = 'update messages_module_revision_request set date_approved = CONVERT_TZ(date_approved,\'+00:00\',\'+02:00\');';
		$this->execute($sqlRevisionRequest);
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_messages_module_revision_request_messages', 'messages_module_revision_request');
		$this->dropForeignKey('FK_messages_module_revision_request_user', 'messages_module_revision_request');
		$this->dropForeignKey('FK_messages_module_revision_request_vc_module', 'messages_module_revision_request');
		$this->dropTable('messages_module_revision_request');
	}
}