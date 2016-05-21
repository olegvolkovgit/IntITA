<?php

class m160508_073140_fix_vc_lecture_properties extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('SELECT @sm:= @@SQL_SAFE_UPDATES;
        SET SQL_SAFE_UPDATES = 0;
        UPDATE vc_lecture_properties SET update_date=null where update_date=0;
        UPDATE vc_lecture_properties SET send_approval_date=null where send_approval_date=0;
        UPDATE vc_lecture_properties SET reject_date=null where reject_date=0;
        UPDATE vc_lecture_properties SET approve_date=null where approve_date=0;
        UPDATE vc_lecture_properties SET end_date=null where end_date=0;
        SET SQL_SAFE_UPDATES = @sm;');
	}

	public function safeDown()
	{
        echo "m160508_073140_fix_vc_lecture_properties does not support migration down.\n";
        return false;
	}
}