<?php

class m160421_112319_add_column_module_price extends CDbMigration
{
	public function up()
	{
		$this->addColumn('module', 'price_offline', 'DECIMAL(10,0) NULL DEFAULT 0');
		$this->insert('config', array(
			'id' => 15,
			'param' => 'coeffModuleOffline',
			'value' => '0.7',
			'default' => '0.7',
			'label' => 'Коефіцієнт модуля для ціни офлайн',
			'type' => 'double'
		));
	}

	public function down()
	{
		echo "m160421_112319_add_column_module_price does not support migration down.\n";
		return false;
	}
}