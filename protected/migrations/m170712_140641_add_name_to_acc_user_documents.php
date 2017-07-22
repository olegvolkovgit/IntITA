<?php

class m170712_140641_add_name_to_acc_user_documents extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_user_documents','last_name','VARCHAR(32) default null');
        $this->addColumn('acc_user_documents','first_name','VARCHAR(32) default null');
        $this->addColumn('acc_user_documents','middle_name','VARCHAR(32) default null');
    }

    public function safeDown()
    {
        $this->dropColumn('acc_user_documents','last_name');
        $this->dropColumn('acc_user_documents','first_name');
        $this->dropColumn('acc_user_documents','middle_name');
    }
}