<?php

class m160417_214912_create_address_tables extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('address_country', array(
			'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
			'title_ua' => 'VARCHAR(50) NULL DEFAULT NULL',
			'title_ru' => 'VARCHAR(50) NULL DEFAULT NULL',
			'title_en' => 'VARCHAR(50) NULL DEFAULT NULL',
            'PRIMARY KEY (`id`)'
		));
        $this->insertMultiple('address_country', array(
            array(
                'id' => 1,
                'title_ua' => 'Україна',
                'title_ru' => 'Украина',
                'title_en' => 'Ukraine'
            ),
            array(
                'id' => 2,
                'title_ua' => 'Білорусь',
                'title_ru' => 'Беларусь',
                'title_en' => 'Belarus'
            ),
            array(
                'id' => 3,
                'title_ua' => 'Молдова',
                'title_ru' => 'Молдова',
                'title_en' => 'Moldova'
            ),
            array(
                'id' => 4,
                'title_ua' => 'Польща',
                'title_ru' => 'Польша',
                'title_en' => 'Poland'
            ),
            array(
                'id' => 5,
                'title_ua' => 'Румунія',
                'title_ru' => 'Румыния',
                'title_en' => 'Romania'
            )
        ));

        $this->createTable('address_city', array(
            'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
            'country' => 'INT(10) NOT NULL',
            'title_ua' => 'VARCHAR(50) NULL DEFAULT NULL',
            'title_ru' => 'VARCHAR(50) NULL DEFAULT NULL',
            'title_en' => 'VARCHAR(50) NULL DEFAULT NULL',
            'PRIMARY KEY (`id`)',
            'INDEX `FK__address_country` (`country`)',
            'CONSTRAINT `FK__address_country` FOREIGN KEY (`country`) REFERENCES `address_country` (`id`)'
        ));

        $this->addColumn('user', 'country', 'INT(10) NULL');
        $this->addColumn('user', 'city', 'INT(10) NULL');

        $this->addForeignKey('FK_user_address_country', 'user', 'country', 'address_country', 'id');
        $this->addForeignKey('FK_user_address_city', 'user', 'city', 'address_city', 'id');
	}

	public function safeDown()
	{
		$this->dropTable('address_country');

        $this->dropForeignKey('FK__address_country', 'address_city');
        $this->dropTable('address_city');

        $this->dropForeignKey('FK_user_address_country', 'user');
        $this->dropForeignKey('FK_user_address_city', 'user');
        $this->dropColumn('user', 'country');
        $this->dropColumn('user', 'city');
	}
}