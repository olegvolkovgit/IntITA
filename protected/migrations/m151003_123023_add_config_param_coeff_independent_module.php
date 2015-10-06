<?php

class m151003_123023_add_config_param_coeff_independent_module extends CDbMigration
{
	public function up()
	{
		$this->insert('config', array('id' => null, 'param' => 'coeffIndependentModule', 'value' => '0.2',
            'default' => '0.2', 'label' => 'Коэффициент независимого модуля', 'type' => 'float', 'hidden' => '0'));
            
	}

	public function down()
	{
		$this->delete('config', 'param="coeffIndependentModule"');
	}
}