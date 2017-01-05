<?php

class m170105_091051_add_roundcube_address extends CDbMigration
{

	public function safeUp()
	{
		$domain = Yii::app()->db->createCommand()
			->select('value')
			->from('config')
			->where('param = "baseUrlWithoutSchema"')
			->queryScalar();

		$this->insert('config', array(
			'param' => 'roundcubeAddress',
			'value' => 'https://mail'.$domain.'/mail',
			'default' => 'https://mail.'.$domain.'/mail',
			'label' => 'Веб інтерфейс поштової скриньки',
			'type' => 'string',
			'hidden' => '0'
		));
	}

	public function safeDown()
	{
		echo "m170105_091051_add_roundcube_address goes down.\n";
		$this->delete('config', "`config`.`param` = 'roundcubeAddress'");
	}
}