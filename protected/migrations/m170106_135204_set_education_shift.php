<?php

class m170106_135204_set_education_shift extends CDbMigration
{
	public function up()
	{
		$this->update('user', array('education_shift'=> 3), 'educform=:value', array(':value'=>3));
	}

	public function down()
	{
		echo "m170106_135204_set_education_shift does not support migration down.\n";
		return false;
	}
}