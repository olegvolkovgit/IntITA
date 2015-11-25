<?php

class m151022_122427_create_table_acc_service extends CDbMigration
{
	public function up()
	{
        $this->createTable('acc_service', array(
            'service_id' => 'pk',
            'description' => 'VARCHAR(512) NOT NULL COMMENT "service description"',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "service creation date"',
            'cancel_date' => 'DATETIME NULL DEFAULT NULL COMMENT "Is cancelled"',
            'billable' => 'TINYINT(1) NOT NULL DEFAULT "1" COMMENT "Is billable"',
            'INDEX `create_date` (`create_date`, `cancel_date`, `billable`)'
        ));
	}

	public function safeDown()
	{
        $this->dropIndex('create_date', 'acc_service');
        $this->dropTable('acc_service');
	}
}