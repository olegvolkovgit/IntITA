<?php

class m160707_211818_add_column_id_teacher_to_messages_author_request extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn("messages_author_request", "id_teacher", "INT(10) NOT NULL");

		$requests=Yii::app()->db->createCommand()
			->select('*')
			->from('messages_author_request')
			->queryAll();
		

		foreach($requests as $request) {
			$idTeacherSql="SELECT sender FROM messages WHERE id=".$request['id_message'];
			$idTeacher = $this->getDBConnection()->createCommand($idTeacherSql)->queryScalar();
			$this->update('messages_author_request', array('id_teacher' => $idTeacher), 'id_message='.$request['id_message']);
		}

		$this->addForeignKey('FK_messages_author_request_user', 'messages_author_request', 'id_teacher', 'user', 'id');
	}

	public function down()
	{
		$this->dropForeignKey('FK_messages_author_request_user', 'messages_author_request');
		$this->dropColumn('messages_author_request', 'id_teacher');
	}
}