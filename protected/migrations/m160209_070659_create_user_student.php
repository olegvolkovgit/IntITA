<?php

class m160209_070659_create_user_student extends CDbMigration
{
	public function up()
	{
        $this->createTable('user_student', array(
            'id_user' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'start_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'end_date' => 'DATETIME NULL DEFAULT NULL',
            'PRIMARY KEY (`id_user`)',
            'CONSTRAINT `FK_user_user_student` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
        ));

        // inserting testers students accounts -
        // student1@gmail.com, student2@gmail.com, student3@gmail.com, student4@gmail.com, student5@gmail.com
        $this->insertMultiple('user_student', array(
            array(
                'id_user' => '51'
            ),
            array(
                'id_user' => '52'
            ),
            array(
                'id_user' => '53'
            ),
            array(
                'id_user' => '54'
            ),
            array(
                'id_user' => '55'
            )
        ));

	}

	public function down()
	{
        $this->dropForeignKey('FK_user_user_student', 'user_student');
        $this->dropTable('user_admin');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}