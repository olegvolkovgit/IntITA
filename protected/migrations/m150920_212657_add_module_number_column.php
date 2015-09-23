<?php

class m150920_212657_add_module_number_column extends CDbMigration
{
	public function safeUp()
	{
        //$this->addColumn('module', 'module_number', 'INT(10) NULL DEFAULT NULL');

        $result = Yii::app()->db->createCommand()
            ->select('module_ID')
            ->from('module')
            ->queryAll();
        for ($i = 0, $count = count($result); $i < $count; $i++){
            $this->update('module', array('module_number' => $result[$i]["module_ID"]), 'module_ID='.$result[$i]["module_ID"]);
        }
	}

	public function down()
	{
        $this->dropColumn('module', 'module_number');
	}
}