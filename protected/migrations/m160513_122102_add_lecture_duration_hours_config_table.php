<?php

class m160513_122102_add_lecture_duration_hours_config_table extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('config', array('id' => null, 'param' => 'lectureDurationInHours', 'value' => '2',
			'default' => '2', 'label' => 'Тривалість заняття в годинах', 'type' => 'double', 'hidden' => '0'));

	}

	public function safeDown()
	{
		$this->delete('config', 'param="lectureDurationInHours"');
	}
}