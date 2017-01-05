<?php

class m170103_192710_create_table_user_specialization extends CDbMigration
{
	public function up()
	{
		$this->createTable('user_specialization', array(
			'id_user' => 'INT(10) NOT NULL',
			'id_specialization' => 'INT(10) NOT NULL',
			'PRIMARY KEY (`id_user`, `id_specialization`)'
		));

		$this->addForeignKey('FK_specialization_user', 'user_specialization', 'id_user', 'user', 'id');
		$this->addForeignKey('FK_specialization_specialization', 'user_specialization', 'id_specialization', 'specializations_group', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_specialization_user', 'user_specialization');
		$this->dropForeignKey('FK_specialization_specialization', 'user_specialization');
		$this->dropTable('user_specialization');
	}
}