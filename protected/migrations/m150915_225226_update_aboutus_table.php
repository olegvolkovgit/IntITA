<?php

class m150915_225226_update_aboutus_table extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('aboutus', 'titleText', 'VARCHAR(6) NOT NULL');
        $this->alterColumn('aboutus', 'textAbout', 'VARCHAR(6) NOT NULL');

        $this->update('step', array('titleText' => '0032', 'textAbout' => '0035'), 'blockID=1');
        $this->update('step', array('titleText' => '0033', 'textAbout' => '0036'), 'blockID=2');
        $this->update('step', array('titleText' => '0034', 'textAbout' => '0037'), 'blockID=3');
	}

	public function down()
	{
		echo "m150915_225226_update_aboutus_table does not support migration down.\n";
		return false;
	}
}