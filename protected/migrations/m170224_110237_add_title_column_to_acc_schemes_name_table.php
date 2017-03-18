<?php

class m170224_110237_add_title_column_to_acc_schemes_name_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('acc_schemes_name', 'title_ua', 'VARCHAR(60) NOT NULL');
		$this->addColumn('acc_schemes_name', 'title_ru', 'VARCHAR(60) NOT NULL');
		$this->addColumn('acc_schemes_name', 'title_en', 'VARCHAR(60) NOT NULL');

		$this->update('acc_schemes_name', array('title_ua' => 'ціна наперед'), 'pay_count=:value', array(':value'=>1));
		$this->update('acc_schemes_name', array('title_ru' => 'цена наперед'), 'pay_count=:value', array(':value'=>1));
		$this->update('acc_schemes_name', array('title_en' => 'price advance'), 'pay_count=:value', array(':value'=>1));

		$this->update('acc_schemes_name', array('title_ua' => '2 проплати'), 'pay_count=:value', array(':value'=>2));
		$this->update('acc_schemes_name', array('title_ru' => '2 оплаты'), 'pay_count=:value', array(':value'=>2));
		$this->update('acc_schemes_name', array('title_en' => '2 payments'), 'pay_count=:value', array(':value'=>2));

		$this->update('acc_schemes_name', array('title_ua' => '3 проплати'), 'pay_count=:value', array(':value'=>3));
		$this->update('acc_schemes_name', array('title_ru' => '3 оплаты'), 'pay_count=:value', array(':value'=>3));
		$this->update('acc_schemes_name', array('title_en' => '3 payments'), 'pay_count=:value', array(':value'=>3));

		$this->update('acc_schemes_name', array('title_ua' => '4 проплати'), 'pay_count=:value', array(':value'=>4));
		$this->update('acc_schemes_name', array('title_ru' => '4 оплаты'), 'pay_count=:value', array(':value'=>4));
		$this->update('acc_schemes_name', array('title_en' => '4 payments'), 'pay_count=:value', array(':value'=>4));

		$this->update('acc_schemes_name', array('title_ua' => '6 проплат'), 'pay_count=:value', array(':value'=>6));
		$this->update('acc_schemes_name', array('title_ru' => '6 оплат'), 'pay_count=:value', array(':value'=>6));
		$this->update('acc_schemes_name', array('title_en' => '6 payments'), 'pay_count=:value', array(':value'=>6));

		$this->update('acc_schemes_name', array('title_ua' => 'помісячно'), 'pay_count=:value', array(':value'=>12));
		$this->update('acc_schemes_name', array('title_ru' => 'ежемесячно'), 'pay_count=:value', array(':value'=>12));
		$this->update('acc_schemes_name', array('title_en' => 'monthly payments'), 'pay_count=:value', array(':value'=>12));

		$this->update('acc_schemes_name', array('title_ua' => 'кредит на 2 роки'), 'pay_count=:value', array(':value'=>24));
		$this->update('acc_schemes_name', array('title_ru' => 'кредит на 2 года'), 'pay_count=:value', array(':value'=>24));
		$this->update('acc_schemes_name', array('title_en' => 'loan for 2 years'), 'pay_count=:value', array(':value'=>24));

		$this->update('acc_schemes_name', array('title_ua' => 'кредит на 3 роки'), 'pay_count=:value', array(':value'=>36));
		$this->update('acc_schemes_name', array('title_ru' => 'кредит на 3 года'), 'pay_count=:value', array(':value'=>36));
		$this->update('acc_schemes_name', array('title_en' => 'loan for 3 years'), 'pay_count=:value', array(':value'=>36));

		$this->update('acc_schemes_name', array('title_ua' => 'кредит на 4 роки'), 'pay_count=:value', array(':value'=>48));
		$this->update('acc_schemes_name', array('title_ru' => 'кредит на 4 года'), 'pay_count=:value', array(':value'=>48));
		$this->update('acc_schemes_name', array('title_en' => 'loan for 4 years'), 'pay_count=:value', array(':value'=>48));

		$this->update('acc_schemes_name', array('title_ua' => 'кредит на 5 роки'), 'pay_count=:value', array(':value'=>60));
		$this->update('acc_schemes_name', array('title_ru' => 'кредит на 5 года'), 'pay_count=:value', array(':value'=>60));
		$this->update('acc_schemes_name', array('title_en' => 'loan for 5 years'), 'pay_count=:value', array(':value'=>60));
	}

	public function down()
	{
		$this->dropColumn('acc_schemes_name', 'title_ua');
		$this->dropColumn('acc_schemes_name', 'title_ru');
		$this->dropColumn('acc_schemes_name', 'title_en');
	}
}