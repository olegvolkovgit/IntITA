<?php

class m160427_145732_move_old_letters_to_messages_table extends CDbMigration
{
	public function up()
	{
		$sql = "SELECT * FROM letters";
		$letters = $this->getDBConnection()->createCommand($sql)->query();

		foreach($letters as $row){
            if($this->getDBConnection()->createCommand('select count()')->queryScalar()) {
                $this->insert('messages', array(
                    'sender' => $row['sender_id'],
                    'create_date' => strtotime($row['date']),
                    'type' => '1',
                    'draft' => '1'
                ));
                $messageId = Yii::app()->db->getLastInsertId();
                $this->insert('message_receiver', array(
                    'id_message' => $messageId,
                    'id_receiver' => $row['addressee_id'],
                    'read' => ($row['status'] != 0) ? $row['date'] : null
                ));
                $this->insert('user_messages', array(
                    'id_message' => $messageId,
                    'subject' => $row['theme'],
                    'text' => $row['text_letter']
                ));
            }
		}
	}

	public function down()
	{
		echo "m160427_145732_move_old_letters_to_messages_table does not support migration down.\n";
		return false;
	}
}