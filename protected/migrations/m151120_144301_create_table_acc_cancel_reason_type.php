<?php

class m151120_144301_create_table_acc_cancel_reason_type extends CDbMigration
{
    public function up()
    {
        $this->createTable('acc_cancel_reason_type', array(
            'id' => 'pk',
            'description' => 'VARCHAR(100) NOT NULL COMMENT `User which have agreement`',
        ));
    }

    public function down()
    {
        $this->dropTable('acc_cancel_reason_type');
    }
}