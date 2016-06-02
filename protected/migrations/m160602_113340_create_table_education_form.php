<?php

class m160602_113340_create_table_education_form extends CDbMigration
{

    public function safeUp()
    {
        $this->createTable('education_form', array(
            'id' => 'pk',
            'title_ua' => 'VARCHAR(30) NOT NULL',
            'title_ru' => 'VARCHAR(30) NOT NULL',
            'title_en' => 'VARCHAR(30) NOT NULL'
        ));
        $this->insertMultiple('education_form', array(
            array(
                'id' => 1,
                'title_en' => 'online',
                'title_ru' => 'онлайн',
                'title_ua' => 'онлайн'
            ),
            array(
                'id' => 2,
                'title_en' => 'offline',
                'title_ru' => 'оффлайн',
                'title_ua' => 'офлайн'
            )
        ));
        $this->addForeignKey('FK_acc_service_education_form', 'acc_service', 'education_form', 'education_form', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('education_form');
        $this->dropForeignKey('FK_acc_service_education_form', 'acc_service');
    }

}