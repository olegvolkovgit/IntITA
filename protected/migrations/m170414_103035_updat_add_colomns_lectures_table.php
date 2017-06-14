<?php

class m170414_103035_updat_add_colomns_lectures_table extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('lectures', 'rate');

        $this->addColumn('lectures', 'understand_rating', 'TINYINT(1) NULL DEFAULT NULL');
        $this->addColumn('lectures', 'interesting_rating', 'TINYINT(1) NULL DEFAULT NULL');
        $this->addColumn('lectures', 'accessibility_rating', 'TINYINT(1) NULL DEFAULT NULL');
	}

	public function down()
	{
        $this->dropColumn('lectures', 'understand_rating');
        $this->dropColumn('lectures', 'interesting_rating');
        $this->dropColumn('lectures', 'accessibility_rating');

		$this->addColumn('lectures', 'rate', 'TINYINT(1) NULL DEFAULT NULL');
	}
}