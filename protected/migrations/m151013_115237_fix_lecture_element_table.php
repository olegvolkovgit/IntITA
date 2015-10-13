<?php

class m151013_115237_fix_lecture_element_table extends CDbMigration
{
	public function up()
	{
		$this->update('lecture_element', array('id_type' => 5), 'id_type=6');
        $this->update('lecture_element', array('id_type' => 1), 'id_type=8');
        $this->update('lecture_element', array('id_type' => 1), 'id_type=9');
        $this->update('lecture_element', array('id_type' => 1), 'id_type=10');
        $this->update('lecture_element', array('id_type' => 1), 'id_type=11');
        $this->update('lecture_element', array('id_type' => 12), 'id_type=13');
	}

	public function down()
	{
		echo "m151013_115237_fix_lecture_element_table does not support migration down.\n";
		return false;
	}
}