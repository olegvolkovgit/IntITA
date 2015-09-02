<?php

class m150901_114947_add_column_is_checked_to_response extends CDbMigration
{
    public function up()
    {
        $this->addColumn('response', 'is_checked', 'TINYINT(1) NULL DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('response', 'is_checked');
    }


    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}