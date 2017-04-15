<?php

class m170414_181259_add_representative_table_fields extends CDbMigration
{
	public function up() {
	    $this->addColumn('acc_corporate_representative', 'full_name_accusative', 'VARCHAR(255)');
	    $this->addColumn('acc_corporate_representative', 'full_name_short', 'VARCHAR(255)');
	    $this->execute('UPDATE acc_corporate_representative t SET t.full_name_accusative = t.full_name');
	    $this->execute('UPDATE acc_corporate_representative t SET t.full_name_short = t.full_name');
        $this->alterColumn('acc_corporate_representative', 'full_name_accusative', 'VARCHAR(255) NOT NULL');
        $this->alterColumn('acc_corporate_representative', 'full_name_short', 'VARCHAR(255) NOT NULL');
    }

	public function down() {
        $this->dropColumn('acc_corporate_representative', 'full_name_accusative');
        $this->dropColumn('acc_corporate_representative', 'full_name_short');
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