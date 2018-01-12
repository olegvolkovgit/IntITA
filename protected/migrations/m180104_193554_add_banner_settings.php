<?php

class m180104_193554_add_banner_settings extends CDbMigration
{

	public function safeUp()
	{
	$this->insert('config', array(
			'param' => 'bannersSlideTime',
            'value' => '4',
            'default' => '4',
            'label' => 'Затримка на слайдері банерів',
            'type' => 'string'
		));

	}

	public function safeDown()
	{
        echo "m180104_193554_add_banner_settings going down.\n";
	    $this->delete('config',"param='bannersSlideTime'");
        return true;
	}

}