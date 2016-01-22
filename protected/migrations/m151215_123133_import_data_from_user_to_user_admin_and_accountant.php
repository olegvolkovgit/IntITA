<?php

class m151215_123133_import_data_from_user_to_user_admin_and_accountant extends CDbMigration
{
	public function safeUp()
	{
        $adminSql = "SELECT `id` FROM user WHERE `user`.`role` = 3";
        $adminArray = $this->getDBConnection()->createCommand($adminSql)->query();
        $accountantSql = "SELECT `id` FROM user WHERE `user`.`role` = 2";
        $accountantArray = $this->getDBConnection()->createCommand($accountantSql)->query();

        foreach($adminArray as $row){
            $this->insert('user_admin', array('id_user' => $row['id']));
         }

        foreach($accountantArray as $row){
            $this->insert('user_accountant', array('id_user' => $row['id']));
        }
    }

	public function down()
	{
		echo "m151215_123133_import_data_from_user_to_user_admin_and_accountant does not support migration down.\n";
		return false;
	}

}