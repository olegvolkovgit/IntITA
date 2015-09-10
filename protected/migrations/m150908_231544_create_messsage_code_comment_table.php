<?php

class m150908_231544_create_messsage_code_comment_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('message_comment', array(
            'message_code' => 'pk',
            'comment' => 'VARCHAR(255) NULL DEFAULT NULL',
        ));
	}

	public function down()
	{
        $this->dropTable('message_comment');
	}
}