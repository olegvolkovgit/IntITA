<?php

class m150915_160111_update_step_table_data extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('step', 'stepTitle', 'VARCHAR(6) NOT NULL');
        $this->alterColumn('step', 'stepText', 'VARCHAR(6) NOT NULL');

        $this->update('step', array('stepTitle' => '0038', 'stepText' => '0044'), 'stepID=1');
        $this->update('step', array('stepTitle' => '0039', 'stepText' => '0045'), 'stepID=2');
        $this->update('step', array('stepTitle' => '0040', 'stepText' => '0046'), 'stepID=3');
        $this->update('step', array('stepTitle' => '0041', 'stepText' => '0047'), 'stepID=4');
        $this->update('step', array('stepTitle' => '0042', 'stepText' => '0048'), 'stepID=5');

	}

	public function down()
	{
		echo "m150915_160111_update_step_table_data does not support migration down.\n";
		return false;
	}
}