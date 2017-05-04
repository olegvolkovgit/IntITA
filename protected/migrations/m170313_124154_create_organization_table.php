<?php

class m170313_124154_create_organization_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('organization', array(
			'id' => 'pk',
			'name' => 'VARCHAR(128) NOT NULL COLLATE `utf8_general_ci`',
		));
		$this->insertMultiple('organization', array(
			array(
				'id' => '1',
				'name' => 'Vinnytsia IT-Academy',
			),
		));
	}

	public function safeDown()
	{
		$this->dropTable('organization');
	}
}