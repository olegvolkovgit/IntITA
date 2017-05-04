<?php

class m170414_175019_add_organization_column_to_user_student_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('user_student', 'id_organization', 'INT(10) NOT NULL');
        $this->update('user_student', array('id_organization' => 1));
        $this->dropPrimaryKey('id_user', 'user_student');
        $this->addPrimaryKey('user_student_pk', 'user_student', ['id_user', 'start_date', 'id_organization']);
        $this->addForeignKey('FK_user_student_organization', 'user_student', 'id_organization', 'organization', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_user_student_user', 'user_student', 'id_user', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user_student_user', 'user_student');
        $this->dropForeignKey('FK_user_student_organization', 'user_student');
        $this->dropPrimaryKey('user_student_pk', 'user_student');
        $this->dropColumn('user_student', 'id_organization');
        $this->addPrimaryKey('user_student_pk', 'user_student', ['id_user', 'start_date']);
    }
}