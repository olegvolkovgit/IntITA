<?php

class m160310_115038_add_records_config_table extends CDbMigration
{

	public function safeUp()
	{
        $this->insertMultiple('config', array(
            array(
                'id' => 12,
                'param' => 'adminId',
                'value' => '2',
                'default' => 2,
                'label' => 'Публічний емейл адміна, використовується в листах-повідомленнях сайта',
                'type' => 'integer'
            ),
            array(
                'id' => 13,
                'param' => 'dollarRate',
                'value' => '26',
                'default' => 26,
                'label' => 'Курс долара, використовується при формуванні ціни курса та модуля',
                'type' => 'double'
            )
        ));
	}

	public function safeDown()
	{
	    echo "m160310_115038_add_records_config_table does not support migration down.\n";
		return false;
	}

}