<?php

class m151001_130056_update_response_table_create_teacher_response_table extends CDbMigration
{

	public function safeUp()
	{
		$sql = "SELECT id, about FROM response";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $this->dropForeignKey('FK__user_2', 'response');
        $this->dropColumn('response', 'about');
        $this->createTable('teacher_response', array(
           'id_teacher' => 'INT(11) NOT NULL',
            'id_response' => 'INT(11) NOT NULL'
        ));
        for ($i = 0, $count=count($result); $i < $count; $i++){
            $this->insert('teacher_response', array(
                'id_teacher' => $result[$i]['about'],
                'id_response' => $result[$i]['id']
            ));
        }
    }

	public function safeDown()
	{
        echo "Migration m151001_130056 does not support migration down.\n";
        return false;
	}

}