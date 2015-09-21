<?php

class m150921_142735_update_forum_topics_posts_tables_data extends CDbMigration
{
//    public function init()
//    {
//        $this->db = 'dbForum';
//    }
//
    public function up()
	{
        $this->db = 'dbForum';
        $this->addColumn('phpbb_topics', 'lecture_id', 'MEDIUMINT(8) UNSIGNED NULL DEFAULT NULL');
	}

	public function down()
	{
        $this->db = 'dbForum';
        $this->dropColumn('phpbb_topics', 'lecture_id');
	}
}