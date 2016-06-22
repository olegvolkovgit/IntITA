<?php

class m160622_181800_create_vc_course_table extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('vc_course', [
            'id_course_revision' => 'INT(10) PRIMARY KEY AUTO_INCREMENT',
            'id_parent' => 'INT(10) DEFAULT NULL',
            'id_course' => 'INT(10) NOT NULL',
            'id_properties' => 'INT(10) NOT NULL',
            'UNIQUE KEY `properties` (`id_properties`)'
        ]);

        $this->createTable('vc_course_properties', [
            'id' => 'INT(10) PRIMARY KEY AUTO_INCREMENT',
            'alias' => 'VARCHAR(20) NOT NULL UNIQUE',
            'language' => 'VARCHAR(6) NOT NULL',
            'title_ua' => 'VARCHAR(100) NOT NULL',
            'title_ru' => 'VARCHAR(100) DEFAULT NULL',
            'title_en' => 'VARCHAR(100) DEFAULT NULL',
            'level' => 'INT(11) NOT NULL',
            'start' => 'DATE NULL DEFAULT NULL',
            'status' => 'TINYINT(4) NOT NULL',
            'modules_count' => 'INT(255) DEFAULT NULL',
            'course_price' => 'DECIMAL(10,0) DEFAULT NULL',
            'for_whom_ua' => 'TEXT DEFAULT NULL',
            'what_you_learn_ua' => 'TEXT DEFAULT NULL',
            'what_you_get_ua' => 'TEXT DEFAULT NULL',
            'for_whom_ru' => 'TEXT DEFAULT NULL',
            'what_you_learn_ru' => 'TEXT DEFAULT NULL',
            'what_you_get_ru' => 'TEXT DEFAULT NULL',
            'for_whom_en' => 'TEXT DEFAULT NULL',
            'what_you_learn_en' => 'TEXT DEFAULT NULL',
            'what_you_get_en' => 'TEXT DEFAULT NULL',
            'course_img' => 'VARCHAR(255) DEFAULT \'courseimg1.png\'',
            'rating' => 'TINYINT(2) DEFAULT NULL',
            'cancelled' => 'TINYINT(1) NOT NULL DEFAULT \'0\'',
            'course_number' => 'INT(10) DEFAULT NULL',
            'UNIQUE KEY `course` (`alias`)',
            'UNIQUE KEY `course_number` (`course_number`)',

            "start_date" => "TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP",
			"id_user_created" => "INT DEFAULT NULL",

			"update_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_updated" => "INT DEFAULT NULL",

			"send_approval_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_sended_approval" => "INT DEFAULT NULL",

			"reject_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_rejected" => "INT DEFAULT NULL",

			"approve_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_approved" => "INT DEFAULT NULL",

			"end_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_cancelled" => "INT DEFAULT NULL",

			"release_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_released" => "INT DEFAULT NULL",

			"cancel_edit_date" => "TIMESTAMP NULL DEFAULT NULL",
			"id_user_cancelled_edit" => "INT DEFAULT NULL",
        ]);

        $this->createTable('vc_course_module', [
            'id' => 'INT(10) PRIMARY KEY AUTO_INCREMENT',
            'id_course_revision' => 'INT(10) NOT NULL',
            'id_module_revision' => 'INT(10) NOT NULL',
            'module_order' => 'INT(10) NOT NULL'
        ]);

        $this->addForeignKey('FK_vc_course_course', 'vc_course', 'id_course', 'course', 'course_ID');
        $this->addForeignKey('FK_vc_course_course_properties', 'vc_course', 'id_properties', 'vc_course_properties', 'id');
        $this->addForeignKey('FK_vc_course_module_course', 'vc_course_module', 'id_course_revision', 'vc_course', 'id_course_revision');
        $this->addForeignKey('FK_vc_course_module_module', 'vc_course_module', 'id_module_revision', 'vc_module', 'id_module_revision');

        return true;
	}


    public function safeDown()
	{
        $this->dropForeignKey('FK_vc_course_course', 'vc_course');
        $this->dropForeignKey('FK_vc_course_course_properties', 'vc_course');
        $this->dropForeignKey('FK_vc_course_module_course', 'vc_course_module');
        $this->dropForeignKey('FK_vc_course_module_module', 'vc_course_module');

        $this->dropTable('vc_course_module');
        $this->dropTable('vc_course_properties');
        $this->dropTable('vc_course');

		return true;
	}
}