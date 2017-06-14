<?php

class m170404_074736_move_newsletter extends CDbMigration
{
	public function up()
	{

	    //Create newsletters table
        $this->createTable('newsletters', array(
            'id' => 'pk',
            'type' => 'VARCHAR(128) NOT NULL COLLATE `utf8_general_ci`',
            'recitients' => 'TEXT DEFAULT NULL COLLATE `utf8_general_ci`',
            'subject' => 'VARCHAR(128) NOT NULL COLLATE `utf8_general_ci`',
            'text' => 'TEXT NOT NULL COLLATE `utf8_general_ci`',
            'created_by' => 'INT(10) NOT NULL',
            'id_organization' => 'INT(10) NOT NULL',
        ));


        $this->addColumn('scheduler_tasks','related_model_id','INT(10) NULL DEFAULT NULL');
        $this->addColumn('scheduler_tasks','id_organization','INT(10) NOT NULL');
        $this->addForeignKey('FK_user_relation','newsletters','created_by','user','id');
        $this->addForeignKey('FK_organization_relation','newsletters','id_organization','organization','id');

        //move data from scheduleTask table
        $tasks = SchedulerTasks::model()->findAll();
        foreach ($tasks as $task){

            $parameters = json_decode($task->parameters,true);
            $newsletter = new Newsletters();
            $newsletter->type = $parameters['type'];
            $newsletter->recitients = (isset($parameters['recipients']))?serialize($parameters['recipients']):null;
            $newsletter->subject = $parameters['subject'];
            $newsletter->text = $parameters['message'];
            $newsletter->created_by = $task->owner;
            $newsletter->id_organization = 1;
            $newsletter->save(false);
            $task->related_model_id = $newsletter->id;
            $task->id_organization = 1;
            $task->save(false);
        }

        $this->dropColumn('scheduler_tasks','parameters');


	}

	public function down()
	{
		echo "m170404_074736_move_newsletter goes down.\n";
		$this->dropForeignKey('FK_user_relation','newsletters');
		$this->dropForeignKey('FK_organization_relation','newsletters');
		$this->dropColumn('scheduler_tasks','related_model_id');
		$this->dropColumn('scheduler_tasks','id_organization');
        $this->addColumn('scheduler_tasks','parameters','TEXT DEFAULT NULL');
		$this->dropTable('newsletters');
		return true;
	}

}