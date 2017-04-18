<?php

class m170414_181300_add_representative_corporate_entity_table_fields extends CDbMigration
{
	public function up() {
	    $this->addColumn('acc_corporate_entity_representatives', 'position_accusative', 'VARCHAR(255)');
	    $this->execute('UPDATE acc_corporate_entity_representatives t SET t.position_accusative = t.position');
        $this->alterColumn('acc_corporate_entity_representatives', 'position_accusative', 'VARCHAR(255) NOT NULL');
    }

	public function down() {
        $this->dropColumn('acc_corporate_entity_representatives', 'position_accusative');
    }

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}