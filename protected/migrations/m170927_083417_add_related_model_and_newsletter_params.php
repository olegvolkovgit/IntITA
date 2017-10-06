<?php

class m170927_083417_add_related_model_and_newsletter_params extends CDbMigration
{
	public function safeUp()
	{
        $this->addColumn('newsletters','related_model_id','INT(10) default 0');
        $this->addColumn('newsletters','template_id','INT(10) default 0');
        $this->addColumn('newsletters','template_params','TEXT default NULL');
	}

	public function safeDown()
	{
		echo "m170927_083417_add_related_model_and_newsletter_params was going down.\n";
        $this->dropColumn('newsletters','related_model_id');
        $this->dropColumn('newsletters','template_id');
        $this->dropColumn('newsletters','template_params');
        return true;
	}

}