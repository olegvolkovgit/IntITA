<?php

class m170418_123807_update_add_rows_module_table extends CDbMigration
{
	public function up()
	{
	    $this->dropColumn('module', 'rating');

	    $this->addColumn('module', 'understand_rating', 'TINYINT(1) NULL DEFAULT NULL');
	    $this->addColumn('module', 'interesting_rating', 'TINYINT(1) NULL DEFAULT NULL');
        $this->addColumn('module', 'accessibility_rating', 'TINYINT(1) NULL DEFAULT NULL');
	}

	public function down()
	{
	    $this->dropColumn('module', 'understand_rating');
	    $this->dropColumn('module', 'interesting_rating');
	    $this->dropColumn('module', 'accessibility_rating');

	    $this->addColumn('module', 'rating', 'TINYINT(1) NULL DEFAULT NULL');
	}
}