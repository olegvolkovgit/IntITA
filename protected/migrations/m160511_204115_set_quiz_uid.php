<?php

class m160511_204115_set_quiz_uid extends CDbMigration {

    public function safeUp() {
        $query = "INSERT INTO `quiz_uid` (`id_module`) VALUES (1)";
        $result = Yii::app()->db->createCommand($query)->query();
        var_dump(Yii::app()->db->getLastInsertID());
        return false;
    }

    public function safeDown() {
        echo "m160511_204115_set_quiz_uid does not support migration down.\n";
        return false;
    }

}