<?php

class m170712_135903_add_contacts_to_acc_corporate_entity extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('acc_corporate_entity','contacts','VARCHAR(256) default null');
    }

    public function safeDown()
    {
        $this->dropColumn('acc_corporate_entity','contacts');
    }
}