<?php

class m170628_140924_add_start_and_end_module_to_rating_user_module extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('rating_user_module', 'start_module', 'DATETIME DEFAULT NULL');
        $this->addColumn('rating_user_module', 'end_module', 'DATETIME DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('rating_user_module', 'start_module');
        $this->dropColumn('rating_user_module', 'end_module');
    }
}