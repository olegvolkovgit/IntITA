<?php

class m151124_154440_update_element_type_table_skip_task extends CDbMigration
{
	public function up()
	{
        $this->update('element_type', array('type' => 'skip task'), 'id=9');
	}

	public function down()
	{
		echo "m151124_154440_update_element_type_table_skip_task does not support migration down.\n";
		return false;
	}
}