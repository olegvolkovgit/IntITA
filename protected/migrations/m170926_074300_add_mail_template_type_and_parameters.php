<?php

class m170926_074300_add_mail_template_type_and_parameters extends CDbMigration
{
	public function safeUp()
	{
	    $this->addColumn('mail_templates','template_type','INT(10) default 1');
	    $this->addColumn('mail_templates','organization_id','INT(10) default 1');
	    $this->addColumn('mail_templates','parameters','TEXT default NULL');
	}

	public function safeDown()
	{
		echo "m170926_074300_add_mail_template_type_and_parameters was giong down.\n";
		$this->dropColumn('mail_templates','template_type');
		$this->dropColumn('mail_templates','organization_id');
		$this->dropColumn('mail_templates','parameters');
		return true;
	}

}