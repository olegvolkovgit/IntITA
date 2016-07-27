<?php

class m160723_100529_vc_course_module_update extends CDbMigration
{
	public function safeUp()
	{
		$this->dropIndex('alias', 'vc_course_properties');
		$this->dropIndex('course', 'vc_course_properties');
		$this->dropIndex('course_number', 'vc_course_properties');
		$this->alterColumn('vc_course_properties', 'alias', 'VARCHAR(20) NOT NULL');
		
		$this->dropForeignKey('FK_vc_course_module_module', 'vc_course_module');
		$this->renameColumn ('vc_course_module', 'id_module_revision', 'id_module');
		$this->addForeignKey('FK_vc_course_module_module', 'vc_course_module', 'id_module', 'module', 'module_ID');
		
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_vc_course_module_module', 'vc_course_module');
		$this->renameColumn ('vc_course_module', 'id_module', 'id_module_revision');
		$this->addForeignKey('FK_vc_course_module_module', 'vc_course_module', 'id_module_revision', 'vc_module', 'id_module_revision');
	}
}