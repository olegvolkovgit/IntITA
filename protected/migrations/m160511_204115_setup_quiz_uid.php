<?php

class m160511_204115_setup_quiz_uid extends CDbMigration {

    private function getQuizId($idModule) {
        $query = "INSERT INTO `quiz_uid` (`id_module`) VALUES ($idModule)";
        $this->dbConnection->createCommand($query)->execute();

        return $this->dbConnection->getLastInsertID();
    }

    private function setPlainTaskUID($uid, $idTest) {

        $query = "UPDATE `plain_task` SET `uid` = $uid WHERE `id`=$idTest AND `uid` IS NULL";
        if ($this->dbConnection->createCommand($query)->execute() != 1) {
            print_r(">>>setPlainTaskUID<<<\r\n");
            print_r($query."\r\n");
            return false;
        }

        $query = "UPDATE `plain_task_answer` SET `quiz_uid` = $uid WHERE `id_plain_task`=$idTest";
        $this->dbConnection->createCommand($query)->execute();

        return true;
    }

    private function setSkipTaskUID($uid, $idTest) {

        $query = "UPDATE `skip_task` SET `uid` = $uid WHERE `id`=$idTest AND `uid` IS NULL";
        if ($this->dbConnection->createCommand($query)->execute() != 1) {
            print_r(">>>setSkipTaskUID<<<\r\n");
            print_r($query."\r\n");
            return false;
        }

        $query = "UPDATE `skip_task_answers` SET `quiz_uid` = $uid WHERE `id_task`=$idTest";
        $this->dbConnection->createCommand($query)->execute();

        $query = "UPDATE `skip_task_marks` SET `quiz_uid` = $uid WHERE `id_task`=$idTest";
        $this->dbConnection->createCommand($query)->execute();

        return true;
    }

    private function setTaskUID($uid, $idTest) {
        $query = "UPDATE `task1` SET `uid` = $uid WHERE `id`=$idTest AND `uid` IS NULL";
        if ($this->dbConnection->createCommand($query)->execute() != 1) {
            print_r(">>>setTaskUID<<<\r\n");
            print_r($query."\r\n");
            return false;
        }

        $query = "UPDATE `task_marks` SET `quiz_uid` = $uid WHERE `id_task`=$idTest";
        $this->dbConnection->createCommand($query)->execute();

        return true;
    }

    private function setTestUID($uid, $idTest) {
        $query = "UPDATE `tests` SET `uid` = $uid WHERE `id`=$idTest AND `uid` IS NULL";
        if ($this->dbConnection->createCommand($query)->execute() != 1) {
            print_r(">>>setTestUID<<<\r\n");
            print_r($query."\r\n");
            return false;
        }

        $query = "UPDATE `tests_answers` SET `quiz_uid` = $uid WHERE `id_test`=$idTest";
        $this->dbConnection->createCommand($query)->execute();

        $query = "UPDATE `tests_marks` SET `quiz_uid` = $uid WHERE `id_test`=$idTest";
        $this->dbConnection->createCommand($query)->execute();

        return true;
    }

    private function setQuizUID($sqlGetQuiz, $setUIDFunction) {

        /*
         * Create [index => ["quizId" => value, "moduleId" => value]].
         */
        $quizzes = $this->dbConnection->createCommand($sqlGetQuiz)->queryAll();

        foreach ($quizzes as $record) {
            $quizUID = $this->getQuizId($record['moduleId']);

            if ($quizUID == 0) {
                print_r(">>>quizUID = $quizUID<<<\r\n");
                var_dump($quizUID);
                return false;
            }

            if ($setUIDFunction($quizUID, $record['quizId']) === false) {
                print_r(">>>$setUIDFunction<<<\r\n");
                var_dump($quizUID);
                return false;
            }
        }

        return true;
    }

    public function safeUp() {
        
        /*remove Skip task foreign keys*/
        $this->dropForeignKey('FK_skip_task_lecture_element', 'skip_task');
        $this->dropForeignKey('FK_skip_task_question_lecture_element', 'skip_task');

        /* Create quiz_uid table*/
        $this->createTable('quiz_uid', [
            'uid' => 'INT(10) AUTO_INCREMENT PRIMARY KEY',
            'id_module' => 'INT(10) NOT NULL'
        ]);

        /* Add uid columns into quiz tables */
        $this->addColumn('plain_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->addColumn('plain_task_answer', 'quiz_uid', 'INT(10) DEFAULT NULL');

        $this->addColumn('skip_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->addColumn('skip_task_answers', 'quiz_uid', 'INT(10) DEFAULT NULL');
        $this->addColumn('skip_task_marks', 'quiz_uid', 'INT(10) DEFAULT NULL');

        $this->addColumn('task1', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->addColumn('task_marks', 'quiz_uid', 'INT(10) DEFAULT NULL');

        $this->addColumn('tests', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->addColumn('tests_answers', 'quiz_uid', 'INT(10) DEFAULT NULL');
        $this->addColumn('tests_marks', 'quiz_uid', 'INT(10) DEFAULT NULL');

        $_self = $this;

        /* Fill uid cells in quiz tables */

        /* Plain task */
        $getAllPlainTasksId =
            "SELECT 
                plain_task.id AS quizId, IF(idModule,idModule,0) AS moduleId
            FROM
                plain_task
                    LEFT JOIN
                lecture_element ON lecture_element.id_block = plain_task.block_element
                    LEFT JOIN
                lectures ON lectures.id = lecture_element.id_lecture;";

        if (!$this->setQuizUID($getAllPlainTasksId, function ($uid, $idTest) use ($_self) {
            $_self->setPlainTaskUID($uid, $idTest);
        })) {
            return false;
        }

        /* Skip task */
        $getAllSkipTasks =
            "SELECT
                `skip_task`.`id` AS quizId,
                IF(`lectures`.`idModule`, `lectures`.`idModule`, 0) AS moduleId
            FROM
                `skip_task`
                    LEFT JOIN
                `lecture_element` ON `lecture_element`.`id_block` = `skip_task`.`condition`
                    LEFT JOIN
                `lectures` ON `lectures`.`id` = `lecture_element`.`id_lecture`;";

        if (!$this->setQuizUID($getAllSkipTasks, function ($uid, $idTest) use ($_self) {
            $_self->setSkipTaskUID($uid, $idTest);
        })) {
            return false;
        }

        /* Task */
        $getAllTasks =
            "SELECT
                `task1`.`id` AS quizId,
                IF(`lectures`.`idModule`, `lectures`.`idModule`, 0) AS moduleId
            FROM
                `task1`
                    LEFT JOIN
                `lecture_element` ON `lecture_element`.`id_block` = `task1`.`id`
                    LEFT JOIN
                `lectures` ON `lectures`.`id` = `lecture_element`.`id_lecture`;";

        if (!$this->setQuizUID($getAllTasks, function ($uid, $idTest) use ($_self) {
            $_self->setTaskUID($uid, $idTest);
        })) {
            return false;
        }

        /* Tests */
        $getAllTests =
            "SELECT
                `tests`.`id` AS quizId,
                IF(`lectures`.`idModule`, `lectures`.`idModule`, 0) AS moduleId
            FROM
                `tests`
                    LEFT JOIN
                `lecture_element` ON `lecture_element`.`id_block` = `tests`.`id`
                    LEFT JOIN
                `lectures` ON `lectures`.`id` = `lecture_element`.`id_lecture`;";

        if (!$this->setQuizUID($getAllTests, function ($uid, $idTest) use ($_self) {
            $_self->setTestUID($uid, $idTest);
        })) {
            return false;
        }

        /* Make uid columns NOT NULL*/
        $this->alterColumn('plain_task', 'uid', 'INT(10) NOT NULL UNIQUE');
        $this->alterColumn('plain_task_answer', 'quiz_uid', 'INT(10) NOT NULL');

        $this->alterColumn('skip_task', 'uid', 'INT(10) NOT NULL UNIQUE');
        $this->alterColumn('skip_task_answers', 'quiz_uid', 'INT(10) NOT NULL');
        $this->alterColumn('skip_task_marks', 'quiz_uid', 'INT(10) NOT NULL');

        $this->alterColumn('task1', 'uid', 'INT(10) NOT NULL UNIQUE');
        $this->alterColumn('task_marks', 'quiz_uid', 'INT(10) NOT NULL');

        $this->alterColumn('tests', 'uid', 'INT(10) NOT NULL UNIQUE');
        $this->alterColumn('tests_answers', 'quiz_uid', 'INT(10) NOT NULL');
        $this->alterColumn('tests_marks', 'quiz_uid', 'INT(10) NOT NULL');

        /* Add foreign keys */
        $this->addForeignKey("FK_plain_task_quiz_uid", 'plain_task', 'uid', 'quiz_uid', 'uid');
        $this->addForeignKey("FK_plain_task_answer_quiz_uid", 'plain_task_answer', 'quiz_uid', 'quiz_uid', 'uid');

        $this->addForeignKey("FK_skip_task_quiz_uid", 'skip_task', 'uid', 'quiz_uid', 'uid');
        $this->addForeignKey("FK_skip_task_answers_quiz_uid", 'skip_task_answers', 'quiz_uid', 'quiz_uid', 'uid');
        $this->addForeignKey("FK_skip_task_marks_quiz_uid", 'skip_task_marks', 'quiz_uid', 'quiz_uid', 'uid');

        $this->addForeignKey("FK_task1_quiz_uid", 'task1', 'uid', 'quiz_uid', 'uid');
        $this->addForeignKey("FK_task_marks_quiz_uid", 'task_marks', 'quiz_uid', 'quiz_uid', 'uid');

        $this->addForeignKey("FK_tests_quiz_uid", 'tests', 'uid', 'quiz_uid', 'uid');
        $this->addForeignKey("FK_tests_answers_quiz_uid", 'tests_answers', 'quiz_uid', 'quiz_uid', 'uid');
        $this->addForeignKey("FK_tests_marks_quiz_uid", 'tests_marks', 'quiz_uid', 'quiz_uid', 'uid');

        /*Create uid fields in vc_* tables*/
        $this->addColumn('vc_plain_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');

        $this->addColumn('vc_skip_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->addColumn('vc_skip_task_answers', 'quiz_uid', 'INT(10) DEFAULT NULL');

        $this->addColumn('vc_task', 'uid', 'INT(10) DEFAULT NULL UNIQUE');

        $this->addColumn('vc_tests', 'uid', 'INT(10) DEFAULT NULL UNIQUE');
        $this->addColumn('vc_tests_answers', 'quiz_uid', 'INT(10) DEFAULT NULL');

        return true;
    }

    public function safeDown() {

        $this->dropColumn('vc_plain_task', 'uid');

        $this->dropColumn('vc_skip_task', 'uid');
        $this->dropColumn('vc_skip_task_answers', 'quiz_uid');

        $this->dropColumn('vc_task', 'uid');

        $this->dropColumn('vc_tests', 'uid');
        $this->dropColumn('vc_tests_answers', 'quiz_uid');
        
        
        $this->dropForeignKey("FK_plain_task_quiz_uid", 'plain_task');
        $this->dropForeignKey("FK_plain_task_answer_quiz_uid", 'plain_task_answer');

        $this->dropForeignKey("FK_skip_task_quiz_uid", 'skip_task');
        $this->dropForeignKey("FK_skip_task_answers_quiz_uid", 'skip_task_answers');
        $this->dropForeignKey("FK_skip_task_marks_quiz_uid", 'skip_task_marks');

        $this->dropForeignKey("FK_task1_quiz_uid", 'task1');
        $this->dropForeignKey("FK_task_marks_quiz_uid", 'task_marks');

        $this->dropForeignKey("FK_tests_quiz_uid", 'tests');
        $this->dropForeignKey("FK_tests_answers_quiz_uid", 'tests_answers');
        $this->dropForeignKey("FK_tests_marks_quiz_uid", 'tests_marks');

        
        $this->dropColumn('plain_task', 'uid');
        $this->dropColumn('plain_task_answer', 'quiz_uid');

        $this->dropColumn('skip_task', 'uid');
        $this->dropColumn('skip_task_answers', 'quiz_uid');
        $this->dropColumn('skip_task_marks', 'quiz_uid');

        $this->dropColumn('task1', 'uid');
        $this->dropColumn('task_marks', 'quiz_uid');

        $this->dropColumn('tests', 'uid');
        $this->dropColumn('tests_answers', 'quiz_uid');
        $this->dropColumn('tests_marks', 'quiz_uid');

        $this->dropTable('quiz_uid');

        $this->addForeignKey('FK_skip_task_lecture_element', 'skip_task', 'condition', 'lecture_element', 'id_block');
        $this->addForeignKey('FK_skip_task_question_lecture_element', 'skip_task', 'question', 'lecture_element', 'id_block');

        return true;

//        echo "m160511_204115_set_quiz_uid does not support migration down.\n";
//        return false;
    }

}