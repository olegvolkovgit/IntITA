<?php

class m171225_174000_add_banners_table extends CDbMigration
{
	public function safeUp()
	{
	$this->createTable('banners', [
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'file_path' => 'VARCHAR(255) NOT NULL',
            'slide_position' => 'INT(10) DEFAULT 0',
            'visible' => 'TINYINT(50) NOT NULL DEFAULT 0'
        ]);
	$this->createIndex('IDX_FILEPATH','banners','file_path');
	}

	public function safeDown()
	{
        echo "m171225_174000_add_banners_table was giong down.\n";
	    $this->dropIndex('IDX_FILEPATH','banners');
	    $this->dropTable('banners');
		return true;
	}
}