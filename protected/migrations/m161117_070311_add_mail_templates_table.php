<?php

class m161117_070311_add_mail_templates_table extends CDbMigration
{
	



	public function safeUp()
	{
		$this->createTable('mail_templates', array(
			'id' => 'pk',
			'title' => 'VARCHAR(255) NOT NULL',
			'subject' => 'VARCHAR(255) NOT NULL',
			'text' => 'TEXT NOT NULL',
			'active' => 'BOOLEAN NOT NULL DEFAULT TRUE',
		));
	}

	public function safeDown()
	{
		echo "m161117_070311_add_mail_templates_table goes down.\n";
		$this->dropTable('mail_templates');
		return true;
	}

}