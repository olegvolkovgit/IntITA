<?php

class m161013_172033_alter_roles_tables extends CDbMigration
{


	public function safeUp()
	{
	    //Role Admin
        $this->addColumn('user_admin', 'assigned_by', "INT  NOT NULL DEFAULT 0");
        $this->addColumn('user_admin', 'cancelled_by', "INT DEFAULT NULL");
        //Role Accountant
        $this->addColumn('user_accountant', 'assigned_by', "INT NOT NULL DEFAULT 0");
        $this->addColumn('user_accountant', 'cancelled_by', "INT DEFAULT NULL");
        //Role trainer
        $this->addColumn('user_trainer', 'assigned_by', "INT NOT NULL DEFAULT 0");
        $this->addColumn('user_trainer', 'cancelled_by', "INT DEFAULT NULL");
        //Role student
        $this->addColumn('user_student', 'assigned_by', "INT NOT NULL DEFAULT 0" );
        $this->addColumn('user_student', 'cancelled_by', "INT DEFAULT NULL");
        //Role consultant
        $this->addColumn('user_consultant', 'assigned_by', "INT NOT NULL DEFAULT 0");
        $this->addColumn('user_consultant', 'cancelled_by', "INT DEFAULT NULL");
        //Role author
        $this->addColumn('teacher_module', 'assigned_by', "INT NOT NULL DEFAULT 0");
        $this->addColumn('teacher_module', 'cancelled_by', "INT DEFAULT NULL");
        //Role content manager
        $this->addColumn('user_content_manager', 'assigned_by', "INT NOT NULL DEFAULT 0");
        $this->addColumn('user_content_manager', 'cancelled_by', "INT DEFAULT NULL");
        //Role content teacher consultant
        $this->addColumn('user_teacher_consultant', 'assigned_by', "INT NOT NULL DEFAULT 0");
        $this->addColumn('user_teacher_consultant', 'cancelled_by', "INT DEFAULT NULL");
        //Role tenant
        $this->addColumn('user_tenant', 'assigned_by', "INT NOT NULL DEFAULT 0");
        $this->addColumn('user_tenant', 'cancelled_by', "INT DEFAULT NULL");

        $this->update('user_admin', array('assigned_by' => '0'));
        $this->update('user_accountant', array('assigned_by' => '0'));
        $this->update('user_trainer', array('assigned_by' => '0'));
        $this->update('user_student', array('assigned_by' => '0'));
        $this->update('user_consultant', array('assigned_by' => '0'));
        $this->update('teacher_module', array('assigned_by' => '0'));
        $this->update('user_content_manager', array('assigned_by' => '0'));
        $this->update('user_teacher_consultant', array('assigned_by' => '0'));
        $this->update('user_tenant', array('assigned_by' => '0'));


        $this->update('user_admin', array('cancelled_by' => '0'), 'end_date IS NOT NULL' );
        $this->update('user_accountant', array('cancelled_by' => '0'), 'end_date IS NOT NULL');
        $this->update('user_trainer', array('cancelled_by' => '0'), 'end_date IS NOT NULL');
        $this->update('user_student', array('cancelled_by' => '0'), 'end_date IS NOT NULL');
        $this->update('user_consultant', array('cancelled_by' => '0'), 'end_date IS NOT NULL');
        $this->update('teacher_module', array('cancelled_by' => '0'), 'end_time IS NOT NULL');
        $this->update('user_content_manager', array('cancelled_by' => '0'), 'end_date IS NOT NULL');
        $this->update('user_teacher_consultant', array('cancelled_by' => '0'), 'end_date IS NOT NULL');
        $this->update('user_tenant', array('cancelled_by' => '0'), 'end_date IS NOT NULL');


	}

	public function safeDown()
	{
        //Role Admin
        $this->dropColumn('user_admin', 'assigned_by');
        $this->dropColumn('user_admin', 'cancelled_by');
        //Role Accountant
        $this->dropColumn('user_accountant', 'assigned_by');
        $this->dropColumn('user_accountant', 'cancelled_by');
        //Role trainer
        $this->dropColumn('user_trainer', 'assigned_by');
        $this->dropColumn('user_trainer', 'cancelled_by');
        //Role student
        $this->dropColumn('user_student', 'assigned_by');
        $this->dropColumn('user_student', 'cancelled_by');
        //Role consultant
        $this->dropColumn('user_consultant', 'assigned_by');
        $this->dropColumn('user_consultant', 'cancelled_by');
        //Role author
        $this->dropColumn('teacher_module', 'assigned_by');
        $this->dropColumn('teacher_module', 'cancelled_by');
        //Role content manager
        $this->dropColumn('user_content_manager', 'assigned_by');
        $this->dropColumn('user_content_manager', 'cancelled_by');
        //Role content teacher consultant
        $this->dropColumn('user_teacher_consultant', 'assigned_by');
        $this->dropColumn('user_teacher_consultant', 'cancelled_by');
        //Role tenant
        $this->dropColumn('user_tenant', 'assigned_by');
        $this->dropColumn('user_tenant', 'cancelled_by');
	}

}