<?php

class m160521_151054_remove_order_from_vc_lecture_properties extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('vc_lecture_properties', 'order');
	}

	public function down()
	{
		echo "m160521_151054_remove_order_from_vc_lecture_properties does not support migration down.\n";
		return false;
	}
}