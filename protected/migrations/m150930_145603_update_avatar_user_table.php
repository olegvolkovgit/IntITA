<?php

class m150930_145603_update_avatar_user_table extends CDbMigration
{
	public function up()
	{
        $this->update('user', array('avatar' => 'noname.png'), 'avatar=Null');
	}

	public function down()
	{
		echo "m150930_145603_update_avatar_user_table does not support migration down.\n";
		return false;
	}
}