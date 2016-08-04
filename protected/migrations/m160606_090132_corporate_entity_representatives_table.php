<?php

class m160606_090132_corporate_entity_representatives_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('acc_corporate_entity_representatives', array(
			'corporate_entity' => 'INT(10) NOT NULL',
			'corporate_representative' => 'INT(10) NOT NULL',
			'representative_order' => 'INT(2) NOT NULL',
			'position' => 'VARCHAR(100) NOT NULL COMMENT \'Посада\'',
            'INDEX `FK_corporate_entity_representatives_corporate_entity` (`corporate_entity`)',
            'INDEX `FK_corporate_entity_representatives_corporate_representative` (`corporate_representative`)',
            'CONSTRAINT `FK_corporate_entity_representatives_corporate_entity` FOREIGN KEY (`corporate_entity`) REFERENCES `acc_corporate_entity` (`id`)',
            'CONSTRAINT `FK_corporate_entity_representatives_corporate_representative` FOREIGN KEY (`corporate_representative`) REFERENCES `acc_corporate_representative` (`id`)'
		));
	}

	public function down()
	{
        $this->dropForeignKey('FK_corporate_entity_representatives_corporate_entity', 'acc_corporate_entity_representatives');
        $this->dropForeignKey('FK_corporate_entity_representatives_corporate_representative', 'acc_corporate_entity_representatives');
		$this->dropTable('acc_corporate_entity_representatives');
	}
}