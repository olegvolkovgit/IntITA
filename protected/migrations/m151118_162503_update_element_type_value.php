<?php

class m151118_162503_update_element_type_value extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	$this->update('element_type', array('type' => 'plaintask'),
            'type="final task"'
        );
	}
//public void update(string $table, array $columns, mixed $conditions='', array $params=array ( ))
	public function safeDown()
	{
        $this->update('element_type', array('type' => 'final task'),
            'type="plaintask"'
        );
	}

}