<?php

class m151008_193852_resorted_modules_in_course extends CDbMigration
{
	public function safeUp()
	{
		$coursesId=[1,2,3,4,5,6,13,14,19,20,21];
		foreach($coursesId as $course){

			$modules = Yii::app()->db->createCommand()
				->select('order')
				->from('course_modules')
				->where('id_course=:id', array(':id'=>$course))
				->order('order asc')
				->queryAll();

			for ($i = 1, $count = count($modules); $i <= $count; $i++ ){
				$this->update('course_modules', array('order' => $i), '`order`='.$modules[$i-1]['order'].' and id_course='.$course);
			}
		}
	}

	public function down()
	{
		echo "m151008_193852_resorted_modules_in_course does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}