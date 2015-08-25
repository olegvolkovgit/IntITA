<?php

class m150825_123908_fix_forums_paths extends CDbMigration
{
	public function up()
	{
        mysql_connect("localhost",Yii::app()->db->username,Yii::app()->db->password);
        mysql_select_db("forum");

        $result = mysql_query ("SELECT forum_id, forum_link FROM phpbb_forums WHERE forum_type=2");
        while ($row = mysql_fetch_array($result)){
            $newPath = substr($row[1], strpos($row[1], '/forum'));
            mysql_query("UPDATE phpbb_forums SET forum_link='$newPath' WHERE forum_id=$row[0]");
        }
        mysql_close();
	}

	public function down()
	{
		echo "m150825_123908_fix_forums_paths does not support migration down.\n";
		return false;
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