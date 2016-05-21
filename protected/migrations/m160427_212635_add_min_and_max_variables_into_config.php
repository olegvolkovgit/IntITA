<?php

class m160427_212635_add_min_and_max_variables_into_config extends CDbMigration
{
	public function safeUp()
	{
		$this->insertMultiple('config', array(
			array(
				'param' => 'minLengthResponse',
				'value' => '20',
				'default' => '20',
				'label' => 'Минимальная длина отзыва',
				'type' => 'integer'
			),
			array(
				'param' => 'maxLengthResponse',
				'value' => '500',
				'default' => '500',
				'label' => 'Максимальная длина отзыва',
				'type' => 'integer'
			),
		));
	}

	public function safeDown()
	{
		$this->delete('config', 'param="minLengthResponse"');
		$this->delete('config', 'param="maxLengthResponse"');
	}
}