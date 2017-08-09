<?php

class m170701_172705_add_column_paid_module_to_rating_user_module extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('rating_user_module', 'paid_module', 'BOOLEAN NOT NULL DEFAULT FALSE');
    }

    public function safeDown()
    {
        $this->dropColumn('rating_user_module', 'paid_module');
    }
}