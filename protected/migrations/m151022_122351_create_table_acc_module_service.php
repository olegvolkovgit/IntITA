<?php

class m151022_122351_create_table_acc_module_service extends CDbMigration
{
	public function up()
	{
        $this->createTable('acc_module_service', array(
            'service_id' => 'INT(10) UNSIGNED NOT NULL COMMENT "Service ID"',
            'module_id' => 'INT(11) NOT NULL COMMENT "Module ID"',
            'INDEX `service_id` (`service_id`, `module_id`)',
            'INDEX `module_id` (`module_id`)'
        ));
	}

	public function safeDown()
	{
        $this->dropIndex('service_id', 'acc_module_service');
        $this->dropIndex('module_id', 'acc_module_service');
        $this->dropTable('acc_module_service');
	}
}