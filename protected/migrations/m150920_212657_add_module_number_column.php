<?php

class m150920_212657_add_module_number_column extends CDbMigration
{
	public function safeUp()
	{
        //$this->addColumn('module', 'module_number', 'INT(10) NULL DEFAULT NULL');

        $result = $this->execute("SELECT module_ID FROM module");
        for ($i = 0, $count = count($result); $i < $count; $i++){
            $this->update('module', array('module_ID' => $result[$i]), 'module_ID='.$result[$i]);
        }
	}

	public function down()
	{
        $this->dropColumn('module', 'module_number');
	}
}