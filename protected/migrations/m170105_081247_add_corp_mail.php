<?php

class m170105_081247_add_corp_mail extends CDbMigration
{

	public function safeUp()
	{
		$this->addColumn('teacher', 'email', 'VARCHAR(255) NULL DEFAULT NULL');
		$this->addColumn('teacher', 'login_token', 'VARCHAR(255) NULL DEFAULT NULL');
		$this->addColumn('teacher', 'isAlias', 'BOOLEAN NOT NULL DEFAULT FALSE');
	}

	public function safeDown()
	{
		$this->dropColumn('teacher', 'email');
		$this->dropColumn('teacher', 'login_token');
		$this->dropColumn('teacher', 'isAlias');
	}
}