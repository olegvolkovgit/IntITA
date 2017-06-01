<?php

class m170507_164543_add_user_module_rating_table extends CDbMigration
{

	public function safeUp()
	{
	$this->createTable('rating_user_module', array(
            'id' => 'pk',
            'id_user' => 'INT(10) NOT NULL',
            'id_module' => 'INT(10) NOT NULL',
            'module_revision'=>'INT(10) NOT NULL',
            'rating' => 'DOUBLE NOT NULL',
            'module_done'=>'TINYINT DEFAULT 0'
        ));
        $this->addForeignKey('FK_module_rating_user_relation', 'rating_user_module', 'id_user', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_module_rating_module_relation', 'rating_user_module', 'id_module', 'module', 'module_ID', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_module_rating_module_revision_relation', 'rating_user_module', 'module_revision', 'vc_module', 'id_module_revision', 'RESTRICT', 'RESTRICT');
	}

	public function safeDown()
	{
	    $this->dropForeignKey('FK_module_rating_user_relation','rating_user_module');
	    $this->dropForeignKey('FK_module_rating_module_relation','rating_user_module');
	    $this->dropForeignKey('FK_module_rating_module_revision_relation','rating_user_module');
        $this->dropTable('rating_user_module');

	}

}