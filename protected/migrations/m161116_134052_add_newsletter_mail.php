<?php

class m161116_134052_add_newsletter_mail extends CDbMigration
{
	public function safeUp()
	{

		$domain = Yii::app()->db->createCommand()
			->select('value')
			->from('config')
			->where('param = "baseUrlWithoutSchema"')
			->queryScalar();

		$this->insert('config', array(
			'param' => 'newsletterMail',
			'value' => 'newsletter@'.$domain,
			'default' => 'newsletter@'.$domain,
			'label' => 'Електронна адреса, що використовується для розсилок',
			'type' => 'string',
			'hidden' => '0'
		));
	}

	public function safeDown()
	{

		$this->delete('config', "`config`.`param` = 'chatPath'");
		echo "161116_134052_add_newsletter_mail downed successful.\n";
		return true;
	}

}