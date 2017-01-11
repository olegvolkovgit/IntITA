<?php

class m161226_151740_update_educform_value_in_user_table extends CDbMigration
{
	public function up()
	{
		$this->update('user', array('educform' => 1), 'educform="Онлайн"');
		$this->update('user', array('educform' => 2), 'educform="Офлайн"');
		$this->update('user', array('educform' => 3), 'educform="Онлайн/Офлайн"');
	}

	public function down()
	{
		echo "m161226_151740_update_educform_value_in_user_table does not support migration down.\n";
		return false;
	}
}