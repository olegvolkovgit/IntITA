<?php

class m160213_091048_create_user_trainer_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_trainer', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'CONSTRAINT `FK_user_trainer_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
		$trainerSql = "SELECT `user_id` FROM teacher as t LEFT JOIN trainer_student as ts ON ts.trainer = t.teacher_id";
		$trainerArray = $this->getDBConnection()->createCommand($trainerSql)->query();
		foreach($trainerArray as $row){
			$this->insert('user_trainer', array('id_user' => $row['user_id']));
		}
	}
	public function safeDown()
	{
		$this->dropForeignKey('FK_user_trainer_user', 'user_trainer');
		$this->dropTable('user_trainer');
	}
}