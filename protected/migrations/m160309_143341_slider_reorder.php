<?php

class m160309_143341_slider_reorder extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$slides = Yii::app()->db->createCommand()
			->select('*')
			->from('carousel')
			->order('order asc')
			->queryAll();

		for ($i = 1, $count = count($slides); $i <= $count; $i++ ){
			$this->update('carousel', array('order' => $i), 'id='.$i);
		}
	}

	public function safeDown()
	{
		echo "m160309_143341_slider_reorder does not support migration down.\n";
		return false;
	}

}