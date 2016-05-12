<?php

class m160511_204015_alter_quiz_tables extends CDbMigration {

    public function safeUp() {
        $this->addColumn('plain_task', 'uid', 'INT(10) NOT NULL');
        $this->addColumn('plain_task_answer', 'quiz_uid', 'INT(10) NOT NULL');
        $this->addColumn('plain_task_marks', 'quiz_uid', 'INT(10) NOT NULL');

        $this->addColumn('skip_task', 'uid', 'INT(10) NOT NULL');
        $this->addColumn('skip_task_answers', 'quiz_uid', 'INT(10) NOT NULL');
        $this->addColumn('skip_task_marks', 'quiz_uid', 'INT(10) NOT NULL');

        $this->addColumn('task1', 'uid', 'INT(10) NOT NULL');
        $this->addColumn('task_marks', 'quiz_uid', 'INT(10) NOT NULL');

        $this->addColumn('tests', 'uid', 'INT(10) NOT NULL');
        $this->addColumn('tests_answers', 'quiz_uid', 'INT(10) NOT NULL');
        $this->addColumn('tests_marks', 'quiz_uid', 'INT(10) NOT NULL');

        return true;
    }

    public function safeDown() {
        $this->dropColumn('plain_task', 'uid');
        $this->dropColumn('plain_task_answer', 'quiz_uid');
        $this->dropColumn('plain_task_marks', 'quiz_uid');

        $this->dropColumn('skip_task', 'uid');
        $this->dropColumn('skip_task_answers', 'quiz_uid');
        $this->dropColumn('skip_task_marks', 'quiz_uid');

        $this->dropColumn('task1', 'uid');
        $this->dropColumn('task_marks', 'quiz_uid');

        $this->dropColumn('tests', 'uid');
        $this->dropColumn('tests_answers', 'quiz_uid');
        $this->dropColumn('tests_marks', 'quiz_uid');
        return false;
    }

}