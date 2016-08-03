<?php

class m160630_085318_add_available_to_release_status_to_vc_lecture_p extends CDbMigration
{
	public function safeUp() {
		$this->addColumn('vc_lecture_properties', 'proposed_to_release_date', 'TIMESTAMP NULL');
		$this->addColumn('vc_lecture_properties', 'id_user_proposed_to_release', 'INT(11) DEFAULT NULL');
	}

	public function safeDown() {
		$this->dropColumn('vc_lecture_properties', 'proposed_to_release_date');
		$this->dropColumn('vc_lecture_properties', 'id_user_proposed_to_release');
		return true;
	}
}