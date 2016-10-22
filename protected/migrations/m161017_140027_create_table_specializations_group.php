<?php

class m161017_140027_create_table_specializations_group extends CDbMigration
{
	public function up()
	{
		$this->createTable('specializations_group', array(
			'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
			'name' => 'VARCHAR(128) NOT NULL',
			'PRIMARY KEY (`id`)'
		));

		$this->insertMultiple('specializations_group', array(
				array(
					'id' => '1',
					'name' => 'Програмісти',
				),
				array(
					'id' => '2',
					'name' => 'Дизайнери',
				),
				array(
					'id' => '3',
					'name' => 'Тестувальники',
				),
				array(
					'id' => '4',
					'name' => 'Системні адміністратори',
				),
			)
		);

		$this->createTable('offline_groups', array(
			'id' => 'pk',
			'name' => 'varchar(128) NOT NULL',
			'start_date' => 'DATE NOT NULL',
			'specialization' => 'INT(10) NOT NULL',
			'city' => 'INT(10) NOT NULL',
		));
		$this->addForeignKey('FK_group_address_city', 'offline_groups', 'city', 'address_city', 'id');

		$this->addForeignKey('FK_offline_groups_specialization', 'offline_groups', 'specialization', 'specializations_group', 'id');
	}

	public function safeDown()
	{
		
		$this->dropForeignKey('FK_group_address_city','offline_groups');
		$this->dropForeignKey('FK_offline_groups_specialization','offline_groups');
		$this->dropTable('offline_groups');
		$this->dropTable('specializations_group');
	}
}