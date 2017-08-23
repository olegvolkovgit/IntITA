<?php

class m170818_091943_create_offline_student_cancel_type_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('offline_student_cancel_type', array(
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'description' => 'VARCHAR(128) NOT NULL',
        ));

        $this->insertMultiple('offline_student_cancel_type', array(
            array(
                'id' => '1',
                'description' => 'академічна відпустка'
            ),
            array(
                'id' => '2',
                'description' => 'розірвання договору студентом'
            ),
            array(
                'id' => '3',
                'description' => 'розірвання договору організацією'
            ),
            array(
                'id' => '4',
                'description' => 'заключення нового договору'
            ),
            array(
                'id' => '5',
                'description' => 'інше'
            )
        ));
	}

	public function down()
	{
        $this->dropTable('offline_student_cancel_type');
	}
}