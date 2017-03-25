<?php

class m170324_214417_create_services_foreign_keys extends CDbMigration
{
	public function safeUp() {
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''))");
        $this->execute("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''))");

        $this->addForeignKey('FK_acc_course_service_course', 'acc_course_service', 'course_id', 'course', 'course_ID', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_acc_course_service_education_form', 'acc_course_service', 'education_form', 'education_form', 'id', 'RESTRICT', 'RESTRICT');

        $this->addForeignKey('FK_acc_module_service_module', 'acc_module_service', 'module_id', 'module', 'module_ID', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_acc_module_service_education_form', 'acc_module_service', 'education_form', 'education_form', 'id', 'RESTRICT', 'RESTRICT');
    }

	public function safeDown() {
        $this->dropForeignKey('FK_acc_course_service_course', 'acc_course_service');
        $this->dropForeignKey('FK_acc_course_service_education_form', 'acc_course_service');

        $this->dropForeignKey('FK_acc_module_service_module', 'acc_module_service');
        $this->dropForeignKey('FK_acc_module_service_education_form', 'acc_module_service');
    }
}