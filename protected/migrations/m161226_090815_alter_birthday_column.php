<?php

class m161226_090815_alter_birthday_column extends CDbMigration
{

	public function safeUp()
	{
		$this->update('user',['birthday' => NULL], 'birthday=""' );
		$this->execute('UPDATE user set birthday = STR_TO_DATE(birthday,\'%d.%m.%Y\')  WHERE `birthday` REGEXP \'[0-9]{1,2}[.full-stop.][0-9]{1,2}[.full-stop.][0-9]{4}\'');
		$this->execute('UPDATE user set birthday = STR_TO_DATE(birthday,\'%d/%m/%Y\')  WHERE `birthday` REGEXP \'[0-9]{2}/[0-9]{2}/[0-9]{4}\'');
		$this->alterColumn('user','birthday','DATE DEFAULT NULL');

	}

	public function safeDown()
	{
		echo "m161226_090815_alter_birthday_column does not support migration down.\n";
	}

}