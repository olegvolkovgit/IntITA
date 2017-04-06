<?php

class m170406_173427_make_id_organization_in_corporate_entity_required extends CDbMigration
{
	public function up() {
        $this->alterColumn('acc_corporate_entity', 'id_organization', 'INT(10) NOT NULL');
    }

	public function down() {
        $this->alterColumn('acc_corporate_entity', 'id_organization', 'INT(10)');
	}
}