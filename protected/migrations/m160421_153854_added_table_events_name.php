<?php

class m160421_153854_added_table_events_name extends CDbMigration
{
	public function up()
	{
$transaction=$this->getDbConnection()->beginTransaction();
        try
        {
		$this->alterColumn('log_tracks', 'event','INT(10) NOT NULL');
		$this->renameColumn('log_tracks', 'event', 'event_id');
		$this->createTable('events_name', array(
                'event_id' => 'INT(10) AUTO_INCREMENT PRIMARY KEY',
                'event_name' => 'string NOT NULL',                          
            ));

        $this->insertMultiple('events_name', array(
            array(
                'event_name' => 'LogIn'
            )));
$this->insertMultiple('events_name', array(
            array(
                'event_name' => 'LogOut'
            )));
$this->insertMultiple('events_name', array(
            array(
                'event_name' => 'TrueAnswer'
            )));
$this->insertMultiple('events_name', array(
            array(
                'event_name' => 'FalseAnswer'
            )));
$this->insertMultiple('events_name', array(
            array(
                'event_name' => 'OpenText'
            )));
$this->insertMultiple('events_name', array(
            array(
                'event_name' => 'OpenQuiz'
            )));
$this->insertMultiple('events_name', array(
            array(
                'event_name' => 'StartVideo'
            )));

	
	$transaction->commit();
        }
        catch(Exception $e)
        {
		echo "Exception: ".$e->getMessage()."\n";
            $transaction->rollback();
            return false;
        }
    

}

	public function down()
	{
		echo "m160421_153854_added_table_events_name does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}