<?php

class m170818_100216_add_cancel_type_to_offline_students extends CDbMigration
{
	public function up()
	{
        $this->addColumn('offline_students','cancel_type','INT(10) default null');
	}

	public function down()
	{
        $this->dropColumn('offline_students','cancel_type');
	}
}