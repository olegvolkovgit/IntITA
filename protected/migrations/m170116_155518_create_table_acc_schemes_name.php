<?php

class m170116_155518_create_table_acc_schemes_name extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('acc_schemes_name', array(
			'pay_count' => 'TINYINT(1) NOT NULL',
			'course_title_ua' => 'VARCHAR(60) NOT NULL',
			'course_title_ru' => 'VARCHAR(60) NOT NULL',
			'course_title_en' => 'VARCHAR(60) NOT NULL',
			'module_title_ua' => 'VARCHAR(60) NOT NULL',
			'module_title_ru' => 'VARCHAR(60) NOT NULL',
			'module_title_en' => 'VARCHAR(60) NOT NULL',
			'PRIMARY KEY (`pay_count`)',
		));

		$this->insertMultiple('acc_schemes_name', array(
			array(
				'pay_count' => 1,
				'course_title_en' => 'Price for the course in advance',
				'course_title_ru' => 'Цена за весь курс наперед',
				'course_title_ua' => 'Ціна за весь курс наперед',
				'module_title_en' => 'Price for the module in advance',
				'module_title_ru' => 'Цена за весь модуль наперед',
				'module_title_ua' => 'Ціна за весь модуль наперед'
			),
			array(
				'pay_count' => 2,
				'course_title_en' => '2 payments for the course',
				'course_title_ru' => '2 оплаты за курс',
				'course_title_ua' => '2 проплати за курс',
				'module_title_en' => '2 payments for the module',
				'module_title_ru' => '2 оплаты за модуль',
				'module_title_ua' => '2 проплати за модуль'
			),
			array(
				'pay_count' => 3,
				'course_title_en' => '3 payments for the course',
				'course_title_ru' => '3 оплаты за курс',
				'course_title_ua' => '3 проплати за курс',
				'module_title_en' => '3 payments for the module',
				'module_title_ru' => '3 оплаты за модуль',
				'module_title_ua' => '3 проплати за модуль'
			),
			array(
				'pay_count' => 4,
				'course_title_en' => '4 payments for the course',
				'course_title_ru' => '4 оплаты за курс',
				'course_title_ua' => '4 проплати за курс',
				'module_title_en' => '4 payments for the module',
				'module_title_ru' => '4 оплаты за модуль',
				'module_title_ua' => '4 проплати за модуль'
			),
			array(
				'pay_count' => 6,
				'course_title_en' => '6 payments for the course',
				'course_title_ru' => '6 оплаты за курс',
				'course_title_ua' => '6 проплати за курс',
				'module_title_en' => '6 payments for the module',
				'module_title_ru' => '6 оплат за модуль',
				'module_title_ua' => '6 проплати за модуль'
			),
			array(
				'pay_count' => 12,
				'course_title_en' => 'monthly payments',
				'course_title_ru' => 'ежемесячно',
				'course_title_ua' => 'помісячно',
				'module_title_en' => 'monthly payments',
				'module_title_ru' => 'ежемесячно',
				'module_title_ua' => 'помісячно'
			),
			array(
				'pay_count' => 24,
				'course_title_en' => 'loan for 2 years',
				'course_title_ru' => 'кредит на 2 года',
				'course_title_ua' => 'кредит на 2 роки',
				'module_title_en' => 'loan for 2 years',
				'module_title_ru' => 'кредит на 2 года',
				'module_title_ua' => 'кредит на 2 роки'
			),
			array(
				'pay_count' => 36,
				'course_title_en' => 'loan for 3 years',
				'course_title_ru' => 'кредит на 3 года',
				'course_title_ua' => 'кредит на 3 роки',
				'module_title_en' => 'loan for 3 years',
				'module_title_ru' => 'кредит на 3 года',
				'module_title_ua' => 'кредит на 3 роки'
			),
			array(
				'pay_count' => 48,
				'course_title_en' => 'loan for 4 years',
				'course_title_ru' => 'кредит на 4 года',
				'course_title_ua' => 'кредит на 4 роки',
				'module_title_en' => 'loan for 4 years',
				'module_title_ru' => 'кредит на 4 года',
				'module_title_ua' => 'кредит на 4 роки'
			),
			array(
				'pay_count' => 60,
				'course_title_en' => 'loan for 5 years',
				'course_title_ru' => 'кредит на 5 года',
				'course_title_ua' => 'кредит на 5 років',
				'module_title_en' => 'loan for 5 years',
				'module_title_ru' => 'кредит на 5 года',
				'module_title_ua' => 'кредит на 5 років'
			),
		));
	}

	public function safeDown()
	{
		$this->dropTable('acc_schemes_name');
	}
}