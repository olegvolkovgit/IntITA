<?php

class m170324_192411_bind_corporate_entity_to_organisation extends CDbMigration
{
	public function safeUp() {
	    $this->addColumn('acc_corporate_entity', 'id_organization', 'INT(10)');
	    $this->addForeignKey('FK_corporate_entity_organisation', 'acc_corporate_entity', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
	    $this->update('acc_corporate_entity', ['id_organization' => 1]);
	}

	public function safeDown() {
	    $this->dropForeignKey('FK_corporate_entity_organisation', 'acc_corporate_entity');
	    $this->dropColumn('acc_corporate_entity', 'id_organization');
	}
}