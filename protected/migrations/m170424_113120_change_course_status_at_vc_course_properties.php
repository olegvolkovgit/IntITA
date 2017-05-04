<?php

class m170424_113120_change_course_status_at_vc_course_properties extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('vc_course_properties', 'status_offline', 'TINYINT(4) NOT NULL DEFAULT 0');
        $this->renameColumn ('vc_course_properties', 'status', 'status_online');

        $this->dropColumn('course', 'modules_count');
        $this->dropColumn('course', 'course_price');
        $this->dropColumn('vc_course_properties', 'modules_count');
        $this->dropColumn('vc_course_properties', 'course_price');
    }

    public function safeDown()
    {
        $this->addColumn('vc_course_properties', 'modules_count', 'INT(255) DEFAULT NULL');
        $this->addColumn('vc_course_properties', 'course_price', 'DECIMAL(10,0) DEFAULT NULL');
        $this->addColumn('course', 'modules_count', 'INT(255) DEFAULT NULL');
        $this->addColumn('course', 'course_price', 'DECIMAL(10,0) DEFAULT NULL');

        $this->dropColumn('vc_course_properties', 'status_offline');
        $this->renameColumn ('vc_course_properties', 'status_online', 'status');
    }
}