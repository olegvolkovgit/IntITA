<?php

class m160213_091109_create_user_consultant_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('user_consultant', array(
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'CONSTRAINT `FK_user_consultant_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		));
		$consultSql = "SELECT `user_id` FROM teacher as t LEFT JOIN teacher_roles as tr ON tr.teacher = t.teacher_id WHERE tr.role = 2";
		$consultArray = $this->getDBConnection()->createCommand($consultSql)->query();
		foreach($consultArray as $row){
			$this->insert('user_consultant', array('id_user' => $row['user_id']));
		}
	}
	public function down()
	{
		$this->dropForeignKey('FK_user_consultant_user', 'user_consultant');
		$this->dropTable('user_consultant');
	}
}