<?php

class m150630_120815_create_course_modules_table extends CDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE `course_modules` (
	`id_course` INT(10) NOT NULL,
	`id_module` INT(10) NOT NULL,
	`order` INT(10) NOT NULL,
	INDEX `FK_course_modules_course` (`id_course`),
	INDEX `FK_course_modules_module` (`id_module`),
	CONSTRAINT `FK_course_modules_course` FOREIGN KEY (`id_course`) REFERENCES `course` (`course_ID`),
	CONSTRAINT `FK_course_modules_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`module_ID`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;";
        Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "DROP TABLE course_modules";
        Yii::app()->db->createCommand($sql)->execute();
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