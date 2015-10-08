<?php

class m150930_154814_create_share_link extends CDbMigration
{
	public function up()
	{
        $this->createTable('share_link', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NULL DEFAULT NULL',
            'link' => 'TEXT'
        ));
        $this->insert('share_link', array(

            'name' => 'OpenBoard',
            'link' => 'https://drive.google.com/file/d/0B3EvwBQUMP1Ya0VUWXhxVjNfRWc/view'
        ));
        $this->insert('share_link', array(

            'name' => 'Description about openBoard',
            'link' => 'https://docs.google.com/document/d/1diaMLtBRRN4rTW0s1UyFHG_TD0IF7m3t6GtyPriNAhg/edit#heading=h.gjdgxs'
        ));

    }

	public function down()
	{
        $this->dropTable('share_link');

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