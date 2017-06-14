<?php

class m170411_174439_add_acc_corporate_entity_representatives_fields extends CDbMigration
{
	public function up()  {
	    $this->addColumn('acc_corporate_entity_representatives', 'id', 'INT UNSIGNED PRIMARY KEY AUTO_INCREMENT FIRST');
	    $this->addColumn('acc_corporate_entity_representatives', 'createdAt', 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
	    $this->addColumn('acc_corporate_entity_representatives', 'deletedAt', 'DATETIME DEFAULT \'9999-12-31 23:59:59\' ');
	}

	public function down() {
        $this->dropColumn('acc_corporate_entity_representatives', 'id');
        $this->dropColumn('acc_corporate_entity_representatives', 'createdAt');
        $this->dropColumn('acc_corporate_entity_representatives', 'deletedAt');
	}
}