<?php

class m160407_114021_create_table_message_teacher_consultant_request extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_teacher_consultant_request', array(
			'id_message' => 'INT NOT NULL',
			'id_module' => 'INT(10) NOT NULL',
			'id_teacher' => 'INT(10) NOT NULL',
			'date_approved' => 'DATETIME NULL',
			'user_approved' => 'INT(10) NULL',
			'cancelled' => 'TINYINT(1) NOT NULL DEFAULT \'0\' COMMENT \'0 - actual, 1 - cancelled\'',
            'CONSTRAINT `FK_messages_teacher_consultant_request_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
            'CONSTRAINT `FK_messages_teacher_consultant_request_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`module_ID`)',
            'CONSTRAINT `FK_messages_teacher_consultant_request_user` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`)',
            'CONSTRAINT `FK_messages_teacher_consultant_request_user_2` FOREIGN KEY (`user_approved`) REFERENCES `user` (`id`)'
		),
			'COMMENT=\'Trainers requests about assigning teacher-consultants for module(to admins).\'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
		);
		$this->insert('messages_type', array(
			'id' => '4',
			'type' => 'teacher_consultant_request',
			'description' => 'Teacher\'s request about assign teacher-consultant for module'
		));
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_messages_teacher_consultant_request_messages', 'messages_teacher_consultant_request');
        $this->dropForeignKey('FK_messages_teacher_consultant_request_module`', 'messages_teacher_consultant_request');
        $this->dropForeignKey('FK_messages_teacher_consultant_request_user', 'messages_teacher_consultant_request');
        $this->dropForeignKey('FK_messages_teacher_consultant_request_user_2', 'messages_teacher_consultant_request');
		$this->dropTable('messages_teacher_consultant_request');
	}
}