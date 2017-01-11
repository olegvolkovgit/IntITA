<?php

class m170103_182320_create_table_user_career extends CDbMigration
{
	public function up()
	{
		$this->createTable('user_career', array(
			'id_user' => 'INT(10) NOT NULL',
			'id_career' => 'INT(10) NOT NULL',
			'PRIMARY KEY (`id_user`, `id_career`)'
		));

		$this->addForeignKey('FK_user_career_user', 'user_career', 'id_user', 'user', 'id');
		$this->addForeignKey('FK_user_career_career', 'user_career', 'id_career', 'careers', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_user_career_user', 'user_career');
		$this->dropForeignKey('FK_user_career_career', 'user_career');
		$this->dropTable('user_career');
	}
}