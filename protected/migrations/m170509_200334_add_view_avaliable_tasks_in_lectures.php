<?php

class m170509_200334_add_view_avaliable_tasks_in_lectures extends CDbMigration
{
	public function safeUp()
	{
	    $viewSQL = 'CREATE VIEW v_tasks_in_lectures AS SELECT vc_lecture.id_lecture, vc_lecture_properties.id_state, vc_lecture_page.quiz, vc_lecture_element.id_type  from vc_lecture 
                    LEFT JOIN vc_lecture_properties ON vc_lecture_properties.id = vc_lecture.id_properties 
                    LEFT JOIN vc_lecture_page ON vc_lecture_page.id_revision = vc_lecture.id_revision 
                    LEFT JOIN vc_lecture_element ON vc_lecture_element.id_page = vc_lecture_page.id WHERE vc_lecture_element.id_type IN (5,6,9,12,13)';
	    $this->execute($viewSQL);
	}

	public function safeDown()
	{
		echo "m170509_200334_add_view_avaliable_tasks_in_lectures does not support migration down.\n";
		$this->execute('DROP VIEW v_tasks_in_lectures');
		return true;
	}

}