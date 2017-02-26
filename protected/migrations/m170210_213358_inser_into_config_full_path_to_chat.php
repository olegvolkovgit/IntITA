<?php

class m170210_213358_inser_into_config_full_path_to_chat extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('config', array(
			'param' => 'fullChatPath',
			'value' => 'https://qa.intita.com/crmChat',
			'default' => 'https://intita.com/crmChat',
			'label' => 'Полній путь к чату',
			'type' => 'string'
		));
	}

	public function safeDown()
	{
		$this->delete('config', "`config`.`param` = 'fullChatPath'");
		echo "m160404_164418_insert_into_config_path_to_chat downed successful.\n";
	}
}