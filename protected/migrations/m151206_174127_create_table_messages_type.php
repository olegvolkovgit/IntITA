<?php

class m151206_174127_create_table_messages_type extends CDbMigration
{
	public function up()
	{
        $this->createTable('messages_type', array(
            'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'type' => 'VARCHAR(50) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
            'PRIMARY KEY (`id`)'
        ));
	}

	public function down()
	{
		$this->dropTable('messages_type');
	}
}