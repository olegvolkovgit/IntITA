<?php

class m170704_115430_create_teacher_calendar_consultation_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('teacher_calendar_consultation', array(
            'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'teacher_id' => 'INT(10) NOT NULL',
            'user_id' => 'INT(10)',
            'lecture_id' => 'INT(10)',
            'start_time' => 'TIMESTAMP NOT NULL',
            'end_time' => 'TIMESTAMP NOT NULL',
            'status' =>  'SMALLINT(6) UNSIGNED DEFAULT 0',
            'date' => 'VARCHAR(256) NOT NULL',
            'year' => 'SMALLINT(6) UNSIGNED NOT NULL',
            'month' => 'SMALLINT(6) UNSIGNED NOT NULL',
            'comment' => 'VARCHAR(256) NULL DEFAULT NULL',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'CONSTRAINT `FK_teacher_calendar_consultation_user` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`)'
        ));
	}

	public function down()
	{
        $this->dropForeignKey('FK_teacher_calendar_consultation_user', 'teacher_calendar_consultation');
        $this->dropTable('teacher_calendar_consultation');
	}
}