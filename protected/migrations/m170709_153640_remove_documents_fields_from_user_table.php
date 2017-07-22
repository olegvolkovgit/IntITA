<?php

class m170709_153640_remove_documents_fields_from_user_table extends CDbMigration
{
    public function safeUp()
    {
        $this->dropColumn('user','passport');
        $this->dropColumn('user','document_type');
        $this->dropColumn('user','document_issued_date');
        $this->dropColumn('user','inn');
        $this->dropColumn('user','passport_issued');
    }

    public function safeDown()
    {
        $this->addColumn('user','passport','VARCHAR(30) default null');
        $this->addColumn('user','document_type',"VARCHAR(30) default 'passport'");
        $this->addColumn('user','document_issued_date','DATE default null');
        $this->addColumn('user','inn','VARCHAR(30) default null');
        $this->addColumn('user','passport_issued', 'VARCHAR(255) default null');
    }
}