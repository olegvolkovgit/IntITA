<?php

class m150915_232953_add_column_and_data_aboutus_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('aboutus', 'titleTextExp', 'VARCHAR(6) NOT NULL');

        $this->update('aboutus', array('titleTextExp' => '0556'), 'blockID=1');
        $this->update('aboutus', array('titleTextExp' => '0557'), 'blockID=2');
        $this->update('aboutus', array('titleTextExp' => '0558'), 'blockID=3');
	}

	public function down()
	{
		echo "m150915_232953_add_column_and_data_aboutus_table does not support migration down.\n";
		return false;
	}

}