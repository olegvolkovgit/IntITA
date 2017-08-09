<?php

class m170701_035455_update_user_table extends CDbMigration {

    public function safeUp() {
            $this->alterColumn('user', 'firstName', 'VARCHAR(255) NOT NULL DEFAULT \'\'');
            $this->alterColumn('user', 'identity', 'VARCHAR(255) NOT NULL DEFAULT \'\'');
            $this->alterColumn('user', 'network', 'VARCHAR(255) NOT NULL DEFAULT \'\'');
            $this->alterColumn('user', 'state', 'TINYINT(1) NOT NULL DEFAULT 0');
            $this->alterColumn('user', 'full_name', 'VARCHAR(255) NOT NULL DEFAULT \'\'');
            $this->alterColumn('user', 'hash', 'VARCHAR(20) NOT NULL DEFAULT \'\'');
            $this->alterColumn('user', 'skype', 'VARCHAR(50) NOT NULL DEFAULT \'\'');
    }

    public function safeDown() {
    }
}