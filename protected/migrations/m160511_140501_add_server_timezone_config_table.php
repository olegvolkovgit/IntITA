<?php

class m160511_140501_add_server_timezone_config_table extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('config', array('id' => null, 'param' => 'serverTimezone', 'value' => 'Europe/Paris',
			'default' => 'Europe/Paris', 'label' => 'Часовий пояс сервера', 'type' => 'string', 'hidden' => '0'));

	}

	public function safeDown()
	{
		$this->delete('config', 'param="serverTimezone"');
	}
}