<?php

class m160417_095713_remove_vc_lecture_page_needless_columns extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('vc_lecture_page', 'start_date');
        $this->dropColumn('vc_lecture_page', 'id_user_created');
        $this->dropColumn('vc_lecture_page', 'update_date');
        $this->dropColumn('vc_lecture_page', 'id_user_updated');
        $this->dropColumn('vc_lecture_page', 'send_approval_date');
        $this->dropColumn('vc_lecture_page', 'id_user_sended_approval');
        $this->dropColumn('vc_lecture_page', 'reject_date');
        $this->dropColumn('vc_lecture_page', 'id_user_rejected');
        $this->dropColumn('vc_lecture_page', 'approve_date');
        $this->dropColumn('vc_lecture_page', 'id_user_approved');
        $this->dropColumn('vc_lecture_page', 'end_date');
        $this->dropColumn('vc_lecture_page', 'id_user_cancelled');
	}

	public function down()
	{
		echo "m160417_095713_remove_vc_lecture_page_needless_columns does not support migration down.\n";
		return false;
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