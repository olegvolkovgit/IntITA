<?php

class m160310_092435_create_table_messages_payment extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('messages_payment', array(
            'id_message' => 'INT(10) NOT NULL',
            'operation_id' => 'INT(10) NOT NULL',
            'CONSTRAINT `FK_messages_payment_messages` FOREIGN KEY (`id_message`) REFERENCES `messages` (`id`)',
            'CONSTRAINT `FK_messages_payment_acc_operation` FOREIGN KEY (`operation_id`) REFERENCES `acc_operation` (`id`)'
        ),
            'COMMENT=\'Notifications about obtain access to course/module\'
            COLLATE=\'utf8_general_ci\'
            ENGINE=InnoDB'
        );
        $this->insert('messages_type', array(
            'id' => '2',
            'type' => 'payment',
            'description' => 'Notifications about paying course/module'
        ));

	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_messages_payment_messages', 'messages_payment');
        $this->dropForeignKey('FK_messages_payment_acc_operation', 'messages_payment');
		$this->dropTable('messages_payment');
	}
}