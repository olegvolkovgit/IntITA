<?php

class m170206_102246_users_email_category extends CDbMigration
{
	public function up()
	{
		$this->addColumn('users_email', 'category', 'INT(10) NOT NULL');
		$this->dropPrimaryKey('email', 'users_email');
		$this->addPrimaryKey('users_email_pk', 'users_email', ['email', 'category']);
		$this->update('users_email', array('category' => 1));

		$this->createTable('emails_category', array(
			'id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
			'title' => 'VARCHAR(128) NOT NULL',
		));

		$this->insertMultiple('emails_category', array(
			array(
				'id' => '1',
				'title' => 'Категорія по замовчуванню',
			),
		));

		$this->addForeignKey('FK_users_email_category', 'users_email', 'category', 'emails_category', 'id');
	}

	public function down()
	{
		$this->dropForeignKey('FK_users_email_category', 'users_email');

		$this->dropPrimaryKey('users_email_pk', 'users_email');
		$this->addPrimaryKey('users_email_pk', 'users_email', ['email']);
		$this->dropColumn('users_email', 'category');

		$this->dropTable('emails_category');
	}

}