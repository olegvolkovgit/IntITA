<?php

class m180122_185701_add_url_to_banners extends CDbMigration
{

	public function safeUp()
	{
	        $this->addColumn('banners', 'url', 'VARCHAR(255) DEFAULT NULL');
	}

	public function safeDown()
	{
			echo "m180122_185701_add_url_to_banners does going down.\n";
			$this->dropColumn('banners','url');
			return true;
	}

}