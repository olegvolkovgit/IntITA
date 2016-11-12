<?php

class m161101_164141_change_offline_students_table extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('FK_offline_students_user','offline_students');
		$this->dropForeignKey('FK_offline_students_subgroup','offline_students');
		$this->dropTable('offline_students');


		$this->createTable('offline_students', array(
			'id' => 'pk',
			'id_user' => 'INT(10) NOT NULL',
			'start_date' => 'DATE DEFAULT NULL',
			'end_date' => 'DATETIME NULL DEFAULT NULL',
			'graduate_date' => 'DATE DEFAULT NULL',
			'id_subgroup' => 'INT(10) NOT NULL',
			'assigned_by' => 'INT(10) NOT NULL',
			'cancelled_by' => 'INT(10) NULL DEFAULT NULL',
			'CONSTRAINT `FK_offline_students_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)',
			'CONSTRAINT `FK_offline_students_subgroup` FOREIGN KEY (`id_subgroup`) REFERENCES `offline_subgroups` (`id`)'
		));
	}

	public function down()
	{
		$this->dropForeignKey('FK_offline_students_user','offline_students');
		$this->dropForeignKey('FK_offline_students_subgroup','offline_students');
		$this->dropTable('offline_students');
	}
}