<?php

class m160801_202836_create_tags_and_module_tags_tables extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('tags', array(
			'id' => 'INT(10) NOT NULL AUTO_INCREMENT',
			'tag_ua' => 'VARCHAR(50) NOT NULL',
			'tag_ru' => 'VARCHAR(50) NOT NULL',
			'tag_en' => 'VARCHAR(50) NOT NULL',
			'PRIMARY KEY (`id`)',
		));
		$this->insertMultiple('tags', array(
				array(
					'id' => '1',
					'tag_ua' => 'Загальна',
					'tag_ru' => 'Общая',
					'tag_en' => 'General'
				),
				array(
					'id' => '2',
					'tag_ua' => 'PHP',
					'tag_ru' => 'PHP',
					'tag_en' => 'PHP'
				),
				array(
					'id' => '3',
					'tag_ua' => 'Мова',
					'tag_ru' => 'Язык',
					'tag_en' => 'Language'
				),
				array(
					'id' => '4',
					'tag_ua' => 'JS',
					'tag_ru' => 'JS',
					'tag_en' => 'JS'
				),
				array(
					'id' => '5',
					'tag_ua' => 'C#',
					'tag_ru' => 'C#',
					'tag_en' => 'C#'
				),
				array(
					'id' => '6',
					'tag_ua' => 'QA',
					'tag_ru' => 'QA',
					'tag_en' => 'QA'
				),
				array(
					'id' => '7',
					'tag_ua' => 'HTML',
					'tag_ru' => 'HTML',
					'tag_en' => 'HTML'
				),
				array(
					'id' => '8',
					'tag_ua' => 'CSS',
					'tag_ru' => 'CSS',
					'tag_en' => 'CSS'
				),
				array(
					'id' => '9',
					'tag_ua' => 'Java',
					'tag_ru' => 'Java',
					'tag_en' => 'Java'
				),
				array(
					'id' => '10',
					'tag_ua' => 'C++',
					'tag_ru' => 'C++',
					'tag_en' => 'C++'
				),
				array(
					'id' => '11',
					'tag_ua' => 'Swift',
					'tag_ru' => 'Swift',
					'tag_en' => 'Swift'
				),
				array(
					'id' => '12',
					'tag_ua' => 'UI',
					'tag_ru' => 'UI',
					'tag_en' => 'UI'
				),
				array(
					'id' => '13',
					'tag_ua' => 'Математика',
					'tag_ru' => 'Математика',
					'tag_en' => 'Math'
				),
				array(
					'id' => '14',
					'tag_ua' => 'Бази даних',
					'tag_ru' => 'Базы данных',
					'tag_en' => 'Databases'
				),
				array(
					'id' => '15',
					'tag_ua' => 'Web',
					'tag_ru' => 'Web',
					'tag_en' => 'Web'
				),
				array(
					'id' => '16',
					'tag_ua' => 'Алгоритм',
					'tag_ru' => 'Алгоритм',
					'tag_en' => 'Algorithm'
				),
			)
		);

		$this->createTable('module_tags', array(
			'id_module' => 'INT(10) NOT NULL',
			'id_tag' => 'INT(10) NOT NULL',
		));

		$this->addForeignKey('FK_module_tags_module', 'module_tags', 'id_module', 'module', 'module_ID');
		$this->addForeignKey('FK_module_tags_tags', 'module_tags', 'id_tag', 'tags', 'id');
	}

	public function safeDown()
	{
		$this->dropForeignKey('FK_module_tags_module', 'module_tags');
		$this->dropForeignKey('FK_module_tags_tags', 'module_tags');
		$this->dropTable('tags');
		$this->dropTable('module_tags');
	}
}