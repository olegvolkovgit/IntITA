`<?php

class m160507_095126_change_vc_lecture_properties_table extends CDbMigration
{
    public function up()
	{
        /*
         * Needs to update default values in table
         * Updating using standard method $this->alterTable fails because other columns of table contains wrong default values.
         * The query of this migration should be performed in single request.
         * That's why I find database name (to maintain compatibility with QA and production versions) from CdbConnection->connectionString
         * and perform raw query.
         */
        $connectionString = $this->dbConnection->connectionString;
        preg_match('/.*dbname=([a-z_]*)/i', $connectionString, $matches);
        $dbName = $matches[1];
        echo $dbName;
        $this->execute('ALTER TABLE `'.$dbName.'`.`vc_lecture_properties` 
                        CHANGE COLUMN `start_date` `start_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                        CHANGE COLUMN `update_date` `update_date` TIMESTAMP NULL DEFAULT NULL ,
                        CHANGE COLUMN `send_approval_date` `send_approval_date` TIMESTAMP NULL DEFAULT NULL ,
                        CHANGE COLUMN `reject_date` `reject_date` TIMESTAMP NULL DEFAULT NULL ,
                        CHANGE COLUMN `approve_date` `approve_date` TIMESTAMP NULL DEFAULT NULL ,
                        CHANGE COLUMN `end_date` `end_date` TIMESTAMP NULL DEFAULT NULL ;
                        ');
	}

	public function down()
	{
		echo "m160507_095126_change_vc_lecture_properties_table does not support migration down.\n";
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