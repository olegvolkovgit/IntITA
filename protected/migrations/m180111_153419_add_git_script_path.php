<?php

class m180111_153419_add_git_script_path extends CDbMigration
{


	public function safeUp()
	{
	$this->insert('config', array(
			'param' => 'gitScriptPath',
            'value' => '/var/www/git.sh',
            'default' => '/var/www/git.sh',
            'label' => 'Шлях до файлу запуску git',
            'type' => 'string'
		));
	}

	public function safeDown()
	{
	echo "m180111_153419_add_git_script_path goes down.\n";
	$this->delete('config',"param='gitScriptPath'");
		return true;
	}
}