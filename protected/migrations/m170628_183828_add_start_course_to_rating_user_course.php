<?php

class m170628_183828_add_start_course_to_rating_user_course extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('rating_user_course', 'start_course', 'DATE DEFAULT NULL');
        $this->update('rating_user_course', array('start_course' => new CDbExpression('date_done')));
    }

    public function safeDown()
    {
        $this->dropColumn('rating_user_course', 'start_course');
    }
}