<?php

class m170706_131554_create_documents_types_table extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('acc_documents_types', array(
            'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
            'title_ua' => 'VARCHAR(128) NOT NULL',
            'title_ru' => 'VARCHAR(128) NOT NULL',
            'title_en' => 'VARCHAR(128) NOT NULL',
        ));

        $this->insertMultiple('acc_documents_types', array(
            array(
                'title_ua' => 'Паспорт',
                'title_ru' => 'Паспорт',
                'title_en' => 'Passport',
            ),
            array(
                'title_ua' => 'Індивідуальний податковий номер',
                'title_ru' => 'Идентификационный номер налогоплательщика',
                'title_en' => 'Taxpayer Identification Number',
            ),
            array(
                'title_ua' => 'Посвідчення',
                'title_ru' => 'Удостоверение',
                'title_en' => 'Certificate',
            ),
        ));
    }

    public function safeDown()
    {
        $this->dropTable('acc_documents_types');
    }
}