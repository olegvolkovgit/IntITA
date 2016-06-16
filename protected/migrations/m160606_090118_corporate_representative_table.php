<?php

class m160606_090118_corporate_representative_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('acc_corporate_representative', array(
			'id' => 'pk',
            'full_name' => 'VARCHAR(255) NOT NULL COMMENT \'ПІБ\'',
		));
	}

	public function down()
	{
		$this->dropTable('acc_corporate_representative');
	}
}