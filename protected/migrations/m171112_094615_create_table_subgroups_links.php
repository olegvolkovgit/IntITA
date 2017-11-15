<?php

class m171112_094615_create_table_subgroups_links extends CDbMigration
{
    public function safeUp() {
        $this->createTable('offline_subgroups_links', [
            'id' => 'INT(10) PRIMARY KEY AUTO_INCREMENT',
            'id_subgroup' => 'INT(11) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
            'link' => 'VARCHAR(512) NOT NULL',
            'updated_by' => 'INT(11) DEFAULT NULL',
            'updated_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('FK_offline_subgroups_links_subgroup','offline_subgroups_links','id_subgroup','offline_subgroups','id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_offline_subgroups_links_user','offline_subgroups_links','updated_by','user','id', 'RESTRICT', 'RESTRICT');

        $offlineSubGroups=OfflineSubgroups::model()->findAll();
        foreach ($offlineSubGroups as $subGroup){
            if($subGroup->link){
                $this->insert('offline_subgroups_links',
                    [
                        'id_subgroup' => $subGroup->id,
                        'description' => 'Корисне посилання',
                        'link' => $subGroup->link,
                        'updated_by' => 56
                    ]);
            }
        }

        $this->dropColumn('offline_subgroups','link');
    }

    public function safeDown() {
        $this->addColumn('offline_subgroups', 'link', 'VARCHAR(255) DEFAULT NULL');

        $this->dropForeignKey('FK_offline_subgroups_links_user','offline_subgroups_links');
        $this->dropForeignKey('FK_offline_subgroups_links_subgroup','offline_subgroups_links');

        $this->dropTable('offline_subgroups_links');
    }
}