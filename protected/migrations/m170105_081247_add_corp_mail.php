<?php

class m170105_081247_add_corp_mail extends CDbMigration
{

	public function safeUp()
	{
		$this->addColumn('teacher', 'corporate_mail', 'VARCHAR(255) NULL DEFAULT NULL');
		$this->addColumn('teacher', 'mail_password', 'VARCHAR(255) NULL DEFAULT NULL');
		$this->addColumn('teacher', 'mailActive', 'BOOLEAN NOT NULL DEFAULT FALSE');
	}

	public function safeDown()
	{
		$this->dropColumn('teacher', 'corporate_mail');
		$this->dropColumn('teacher', 'mail_password');
		$this->dropColumn('teacher', 'mailActive');
	}
}