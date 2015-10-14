<?php

class m151013_144739_fix_default_teacher_avatar extends CDbMigration
{
	public function up()
	{
        $sql = "UPDATE teacher SET `foto_url` = 'noname2.png' WHERE `foto_url` = 'noname.png'";
		$this->execute($sql);
	}

	public function down()
	{
		echo "m151013_144739_fix_default_teacher_avatar does not support migration down.\n";
		return false;
	}
}