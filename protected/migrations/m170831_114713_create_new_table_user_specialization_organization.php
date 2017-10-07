<?php

class m170831_114713_create_new_table_user_specialization_organization extends CDbMigration
{
    public function safeUp()
	{
        $this->createTable('user_specialization_organization', array(
            'id_student_info' => 'INT(11) NOT NULL',
            'id_specialization' => 'INT(10) NOT NULL',
            'id_organization' => 'INT(10) NOT NULL',
        ));
	}

	public function safeDown()
	{
        $this->dropTable('user_specialization_organization');
	}
}