<?php

class m161114_110916_insert_authors_to_user_author_table extends CDbMigration
{
	public function safeUp()
	{
		$sql = "SELECT DISTINCT idTeacher FROM teacher_module";
		$result = Yii::app()->db->createCommand($sql)->queryAll();

		for ($i = 0, $count = count($result); $i < $count; $i++) {
			$this->insert('user_author', array(
				'id_user' => $result[$i]['idTeacher'],
				'start_date' => new CDbExpression('NOW()'),
				'assigned_by' => '38',
			));
		}
	}

	public function safeDown()
	{
		$this->truncateTable('user_author');
	}
}