<?php

class m170412_064135_create_lectures_rating_table extends CDbMigration
{
	public function up()
	{
	    $this->createTable('lectures_rating', array(
	        'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'id_revision' => 'INT(10) NOT NULL',
            'id_lecture' => 'INT(10) NOT NULL',
            'id_user' => 'INT(10) NOT NULL',
            'understand_rating' => 'TINYINT(1) NULL DEFAULT NULL',
            'interesting_rating' => 'TINYINT(1) NULL DEFAULT NULL',
            'accessibility_rating' => 'TINYINT(1) NULL DEFAULT NULL',
            'comment' => 'VARCHAR(512) NULL DEFAULT NULL',
            'create_date' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'CONSTRAINT `FK_lectures_rating_vc_lecture` FOREIGN KEY (`id_revision`) REFERENCES `vc_lecture` (`id_revision`)',
            'CONSTRAINT `FK_lectures_rating_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
        ));
	}

	public function down()
	{
        $this->dropForeignKey('FK_lectures_rating_user', 'lectures_rating');
        $this->dropForeignKey('FK_lectures_rating_vc_lecture', 'lectures_rating');
        $this->dropTable('lectures_rating');
	}
}