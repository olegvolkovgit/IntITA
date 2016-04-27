<?php

class m160427_141936_add_user_agreements_table_column extends CDbMigration
{
	public function up()
	{
		$this->addColumn('acc_user_agreements', 'education_form', 'TINYINT(1) DEFAULT 0 COMMENT " 0 - online, 1 - offline"');
	}

	public function down()
	{
		$this->dropColumn('acc_user_agreements', 'education_form');
	}
}