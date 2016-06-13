<?php

class m160611_115917_add_mail_setting_to_config_table extends CDbMigration
{
	public function up()
	{
		$this->insert('config', array(
			'param' => 'notifyMail',
            'value' => 'no-reply@intita.com',
            'default' => 'no-reply@intita.com',
            'label' => 'Пошта, яка відображається в системних повідомленнях.',
            'type' => 'string'
		));
	}

	public function down()
	{
		echo "m160611_115917_add_mail_setting_to_config_table does not support migration down.\n";
		return false;
	}
}