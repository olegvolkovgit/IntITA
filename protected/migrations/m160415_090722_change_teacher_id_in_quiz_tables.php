<?php

class m160415_090722_change_teacher_id_in_quiz_tables extends CDbMigration
{
	public function safeUp()
	{
		$sqlPlainTask = "update plain_task set author = (select user_id from teacher t where t.teacher_id=plain_task.author);";
		$this->execute($sqlPlainTask);

        $this->dropForeignKey('FK_project_teacher', 'project');
		$sqlProject = "update project p set id_leader = (select user_id from teacher t where t.teacher_id=p.id_leader);";
		$this->execute($sqlProject);

        $this->dropForeignKey('FK_skip_task_teacher', 'skip_task');
        $sqlSkipTask = "update skip_task st set author = (select user_id from teacher t where t.teacher_id=st.author);";
        $this->execute($sqlSkipTask);

        $this->dropForeignKey('FK_task1_teacher', 'task1');
        $sqlTask = "update task1 t set author = (select user_id from teacher t where t.teacher_id=t.author);";
        $this->execute($sqlTask);

        $sqlTests = "update tests t set author = (select user_id from teacher t where t.teacher_id=t.author);";
        $this->execute($sqlTests);
	}

	public function down()
	{
		echo "m160415_090722_change_teacher_id_in_quiz_tables does not support migration down.\n";
		return false;
	}
}