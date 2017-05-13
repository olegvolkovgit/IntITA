<?php

class m170511_103950_update_response_table extends CDbMigration
{
    public function up()
    {
        $this->alterColumn('response', 'is_checked', 'TINYINT(1) NULL DEFAULT NULL');
    }

    public function down()
    {
        $this->alterColumn('response', 'is_checked', 'TINYINT(1) NULL DEFAULT 0');
    }
}