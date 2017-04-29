<?php

class m170418_134700_create_module_rating_table extends CDbMigration
{
	public function up()
	{
	    $this->createTable('module_rating', array(
	       'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'id_module' => 'INT(10) NOT NULL',
            'id_module_revision' => 'INT(10) NOT NULL',
            'id_user' => 'INT(10) NOT NULL',
            'understand_rating' => 'TINYINT(1) NULL DEFAULT NULL',
            'interesting_rating' => 'TINYINT(1) NULL DEFAULT NULL',
            'accessibility_rating' => 'TINYINT(1) NULL DEFAULT NULL',
            'comment' => 'VARCHAR(512) NULL DEFAULT NULL',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'CONSTRAINT `FK_module_rating_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
        ));
	}

	public function down()
	{
		$this->dropForeignKey('FK_module_rating_user', 'module_rating');
		$this->dropTable('module_rating');
	}
}