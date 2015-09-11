<?php

class m150911_141940_fix_teacher_default_photo extends CDbMigration
{
	public function up()
	{
        $this->update('teacher', array('foto_url' => 'noname2.png'),
            'foto_url="noname.png"'
        );
    }

	public function down()
	{
        $this->update('teacher', array('foto_url' => 'noname.png'),
            'foto_url="noname2.png"'
        );
	}
}