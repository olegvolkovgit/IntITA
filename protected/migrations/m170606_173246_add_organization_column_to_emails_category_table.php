<?php

class m170606_173246_add_organization_column_to_emails_category_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('emails_category', 'id_organization', 'INT(10) NOT NULL');
        $this->update('emails_category', array('id_organization' => 1));
        $this->addForeignKey('FK_emails_category_organization', 'emails_category', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_emails_category_organization', 'emails_category');
        $this->dropColumn('emails_category', 'id_organization');
    }
}