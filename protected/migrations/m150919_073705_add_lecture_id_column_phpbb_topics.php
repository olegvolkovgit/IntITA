<?php

class m150919_073705_add_lecture_id_column_phpbb_topics extends CDbMigration
{
	public function up()
	{
        Yii::app()->dbForum->addColumn('phpbb_topics', 'lecture_id', 'mediumint(8) unsigned DEFAULT NULL');
	}

	public function down()
	{
        Yii::app()->dbForum->dropColumn('phpbb_topics', 'lecture_id');
	}
}