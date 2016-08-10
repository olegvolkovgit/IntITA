<?php

class m160808_205218_change_config_column_coeff_independent_module extends CDbMigration
{
	public function safeUp()
	{
		$this->update('config', array('param' => 'coeffDependentModule',
			'value'=>0.75,
			'label'=>'Коэффициент модуля в курсе'), 'id=10');
	}

	public function safeDown()
	{
		$this->update('config', array('param' => 'coeffIndependentModule',
			'value'=>1.5,
			'label'=>'Коэффициент независимого модуля'), 'id=10');
	}
}