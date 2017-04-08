<?php

class m170406_173427_make_id_organization_in_corporate_entity_required extends CDbMigration
{
	public function up() {
	    $this->dropForeignKey('FK_corporate_entity_organisation', 'acc_corporate_entity');
        $this->alterColumn('acc_corporate_entity', 'id_organization', 'INT(10) NOT NULL');
        $this->addForeignKey('FK_corporate_entity_organisation', 'acc_corporate_entity', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
    }

	public function down() {
        $this->dropForeignKey('FK_corporate_entity_organisation', 'acc_corporate_entity');
        $this->alterColumn('acc_corporate_entity', 'id_organization', 'INT(10)');
        $this->addForeignKey('FK_corporate_entity_organisation', 'acc_corporate_entity', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
	}
}