<?php

class m160531_092826_add_vc_lecture_cancel_edit_by_editor extends CDbMigration
{
	public function safeUp() {
		$this->addColumn('vc_lecture_properties', 'cancel_edit_date', 'TIMESTAMP NULL');
		$this->addColumn('vc_lecture_properties', 'id_user_cancelled_edit', 'INT(11) DEFAULT NULL');
	}

	public function safeDown() {
		$this->dropColumn('vc_lecture_properties', 'cancel_edit_date');
		$this->dropColumn('vc_lecture_properties', 'id_user_cancelled_edit');
		return true;
	}
}