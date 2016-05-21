<?php

class m160404_164418_insert_into_config_path_to_chat extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('config', array(
			'param' => 'chatPath',
			'value' => '/crmChat/#/private_dialog_view/',
			'default' => '/crmChat/',
			'label' => 'Путь к приватному диалогу чата',
			'type' => 'string'
		));
	}

	public function safeDown()
	{
		$this->delete('config', "`config`.`param` = 'chatPath'");
		echo "m160404_164418_insert_into_config_path_to_chat downed successful.\n";
	}
}