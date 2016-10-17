<?php

class m161017_113636_cancelled_history extends CDbMigration
{


	public function safeUp()
	{
		$this->createTable('user_blocked', array(
			'id' => 'pk',
			'id_user' => 'INT(10) NOT NULL',
			'locked_by' => 'INT(10) NOT NULL',
			'locked_date'=>'DATETIME NULL DEFAULT NULL',
			'unlocked_by' => 'INT(10) DEFAULT NULL',
			'unlocked_date'=>'DATETIME NULL DEFAULT NULL',
			'CONSTRAINT `FK_cancelled_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)'
		),
			'COMMENT=\'History of cancel user action\'
             COLLATE=\'utf8_general_ci\'
             ENGINE=InnoDB'
		);

		$cancelledUsers = Yii::app()->db->createCommand()
						->select('id')
						->from('user')
						->where('cancelled = 1')
						->queryAll();
		foreach ($cancelledUsers as $user){
			$this->insert('user_blocked',[
				'id_user' => $user['id'],
				'locked_by'=>'0',
				'locked_date'=>date("Y-m-d H:i:s"),
			]);
		}

	}

	public function safeDown()
	{	$this->dropForeignKey('FK_cancelled_user', 'user_blocked');
		$this->dropTable('user_blocked');
		return true;
	}
}