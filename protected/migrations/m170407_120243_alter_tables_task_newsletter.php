<?php

class m170407_120243_alter_tables_task_newsletter extends CDbMigration
{
	public function up()
	{
	    $this->renameColumn('scheduler_tasks','owner','created_by');
	    $this->renameColumn('newsletters','recitients','recipients');
	    $this->addColumn('newsletters','newsletter_email','VARCHAR(255) NOT NULL');
	}

	public function down()
	{
		echo "m170407_120243_alter_tables_task_newsletter going down.\n";
        $this->renameColumn('scheduler_tasks','created_by','owner');
        $this->renameColumn('newsletters','recipients','recitients');
        $this->dropColumn('newsletters','newsletter_email');
		return true;
	}

}