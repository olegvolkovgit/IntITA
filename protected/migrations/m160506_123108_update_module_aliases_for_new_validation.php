<?php

class m160506_123108_update_module_aliases_for_new_validation extends CDbMigration
{
	public function up()
	{
		$sql = "UPDATE module SET alias = CONCAT('id', alias) where alias REGEXP '^[0-9]+$';";
        $this->execute($sql);
	}

	public function down()
	{
		echo "m160506_123108_update_module_aliases_for_new_validation does not support migration down.\n";
		return false;
	}
}