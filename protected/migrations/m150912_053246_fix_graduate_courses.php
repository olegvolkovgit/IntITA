<?php

class m150912_053246_fix_graduate_courses extends CDbMigration
{
    public function up()
    {
        $courses = Yii::app()->db->createCommand()
            ->select('id, courses_page')
            ->from('graduate')
            ->queryAll();

        for ($i = 0, $count = count($courses); $i < $count; $i++) {
            if ($courses[$i]["courses_page"] != '') {
                $oldValue = explode('/', $courses[$i]["courses_page"]);
                $this->update('graduate', array('courses_page' => array_pop($oldValue)),
                    'courses_page=:old', array(':old' => $courses[$i]["courses_page"])
                );
            }
        }
    }

    public function down()
    {
        echo "m150912_053246_fix_graduate_courses does not support migration down.\n";
        return false;
    }
}