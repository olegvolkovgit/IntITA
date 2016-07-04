<?php

class m160704_132941_add_reject_field_to_message_module_revision_request extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('messages_module_revision_request', 'date_rejected', 'DATETIME NULL');
		$this->addColumn('messages_module_revision_request', 'user_rejected', 'INT(10) NULL');
		$this->addForeignKey('FK_messages_module_revision_request_user_rejected', 'messages_module_revision_request', 'user_rejected', 'user', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_messages_module_revision_request_user_rejected', 'messages_module_revision_request');
		$this->dropColumn('messages_module_revision_request', 'date_rejected');
		$this->dropColumn('messages_module_revision_request', 'user_rejected');
	}
}