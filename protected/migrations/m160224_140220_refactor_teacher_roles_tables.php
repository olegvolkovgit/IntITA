<?php

class m160224_140220_refactor_teacher_roles_tables extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('user_trainer', 'capacity', 'INT(10) NULL DEFAULT NULL');

        $this->dropForeignKey('FK_attribute_value_role_attribute', 'attribute_value');
        $this->dropForeignKey('FK_attribute_value_roles', 'attribute_value');

        $this->dropTable('attribute_value');

        $this->dropForeignKey('FK_role_attribute_roles', 'role_attribute');
        $this->dropTable('role_attribute');

        $trainersSql = "select distinct t.user_id from teacher_roles tr left join teacher t on tr.teacher = t.teacher_id  where tr.role=1 and t.user_id not in (select user_id from user_trainer)";
	    $trainers = $this->getDBConnection()->createCommand($trainersSql)->query();
        if(!empty($trainers)) {
            foreach ($trainers as $row) {
                $this->insert('user_trainer', array('id_user' => $row['user_id']));
            }
        }

        $consultantsSql = "select distinct t.user_id from teacher_roles tr left join teacher t on tr.teacher = t.teacher_id  where tr.role=2 and t.user_id not in (select user_id from user_consultant)";
        $consultants = $this->getDBConnection()->createCommand($consultantsSql)->query();
        if(!empty($consultants)) {
            foreach ($consultants as $row) {
                $this->insert('user_consultant', array('id_user' => $row['user_id']));
            }
        }

        $this->dropForeignKey('FK_teacher_roles_roles', 'teacher_roles');
        $this->dropForeignKey('FK_teacher_roles_teacher', 'teacher_roles');

        $this->dropTable('roles');
        $this->dropTable('teacher_roles');
    }

	public function safeDown()
	{
	    echo "m160224_140220_refactor_teacher_roles_tables does not support migration down.\n";
		return false;
	}

}