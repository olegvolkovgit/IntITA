<?php

class m170507_164555_add_user_course_rating_table extends CDbMigration
{

	public function safeUp()
	{
	$this->createTable('rating_user_course', array(
            'id' => 'pk',
            'id_user' => 'INT(10) NOT NULL',
            'id_course' => 'INT(10) NOT NULL',
            'course_revision'=>'INT(10) NOT NULL',
            'rating' => 'DOUBLE NOT NULL',
            'course_done'=>'TINYINT DEFAULT 0'
        ));
        $this->addForeignKey('FK_course_rating_user_relation', 'rating_user_course', 'id_user', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_course_rating_course_relation', 'rating_user_course', 'id_course', 'course', 'course_ID', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_course_rating_course_revision_relation', 'rating_user_course', 'course_revision', 'vc_course', 'id_course_revision', 'RESTRICT', 'RESTRICT');
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_course_rating_user_relation','rating_user_course');
        $this->dropForeignKey('FK_course_rating_course_relation','rating_user_course');
        $this->dropForeignKey('FK_course_rating_course_revision_relation','rating_user_course');
        $this->dropTable('rating_user_course');
	}

}