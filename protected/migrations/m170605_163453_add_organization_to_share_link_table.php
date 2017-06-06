<?php

class m170605_163453_add_organization_to_share_link_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('share_link', 'id_organization', 'INT(10) NOT NULL');
        $this->update('share_link', array('id_organization' => 1));
        $this->addForeignKey('FK_share_link_organization', 'share_link', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_share_link_organization', 'share_link');
        $this->dropColumn('share_link', 'id_organization');
    }
}