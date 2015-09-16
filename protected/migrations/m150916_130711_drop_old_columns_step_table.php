<?php

class m150916_130711_drop_old_columns_step_table extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('step', 'stepName');
        $this->dropColumn('step', 'stepImagePath');
        $this->dropColumn('step', 'language');
	}

	public function down()
	{
		echo "m150916_130711_drop_old_columns_step_table does not support migration down.\n";
		return false;
	}
}