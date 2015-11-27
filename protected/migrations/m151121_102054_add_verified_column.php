<?php

class m151121_102054_add_verified_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('lectures', 'verified', 'TINYINT(1) NOT NULL DEFAULT `0`');
	}

	public function down()
	{
        $this->dropColumn('lectures', 'verified');
	}
}