<?php

class m160505_094941_add_column_cancelled_user_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('user', 'cancelled', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT \'0 - actual, 1 - cancelled\'');
	}

	public function down()
	{
		$this->dropColumn('user', 'cancelled');
	}
}