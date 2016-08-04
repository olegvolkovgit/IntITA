<?php

class m160606_094025_add_column_status_user_agreement extends CDbMigration
{
	public function up()
	{
        $this->createTable('acc_user_agreement_status', array(
            'id' => 'pk',
            'title_ua' => 'VARCHAR(30) NOT NULL',
            'title_ru' => 'VARCHAR(30) NOT NULL',
            'title_en' => 'VARCHAR(30) NOT NULL'
        ));

        $this->addColumn('acc_user_agreements', 'status', 'INT(11) NOT NULL DEFAULT \'1\'');

        $this->insertMultiple('acc_user_agreement_status', array(
           array(
               'id' => 1,
               'title_ua' => 'створений',
               'title_ru' => 'создан',
               'title_en' => 'created'
           ),
            array(
                'id' => 2,
                'title_ua' => 'відправлений',
                'title_ru' => 'отправлен',
                'title_en' => 'sent'
            ),
            array(
                'id' => 3,
                'title_ua' => 'отриманий',
                'title_ru' => 'полученный',
                'title_en' => 'received'
            ),
        ));

        $this->createTable('acc_agreement_status_action', array(
            'agreement' => 'INT NOT NULL',
            'date' => 'TIMESTAMP NOT NULL',
            'user' => 'INT NOT NULL',
            'new_status' => 'INT NOT NULL',
            'CONSTRAINT `FK_acc_agreement_status_action_acc_user_agreements` FOREIGN KEY (`agreement`) REFERENCES `acc_user_agreements` (`id`)',
            'CONSTRAINT `FK_acc_agreement_status_action_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`)',
            'CONSTRAINT `FK_acc_agreement_status_action_acc_user_agreement_status` FOREIGN KEY (`new_status`) REFERENCES `acc_user_agreement_status` (`id`)'
        ));

        $this->addForeignKey('FK_acc_user_agreements_acc_user_agreement_status', 'acc_user_agreements', 'status',
            'acc_user_agreement_status', 'id');
	}

	public function down()
	{
		$this->dropColumn('acc_user_agreements', 'status');
        $this->dropTable('acc_user_agreement_status');
        $this->dropTable('acc_user_');
	}
}