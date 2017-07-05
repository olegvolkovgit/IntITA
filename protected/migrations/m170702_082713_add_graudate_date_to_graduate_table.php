<?php

class m170702_082713_add_graudate_date_to_graduate_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('graduate','graduate_date','DATE NOT NULL');
        foreach (Graduate::model()->findAll() as $graduate){
            $courseProgress=RatingUserCourse::model()->find('id_user='.$graduate->id_user);
            $this->update('graduate',[
                'graduate_date'=>$courseProgress->date_done,
            ],'id_user='.$graduate->id_user);
        }
    }

    public function safeDown()
    {
        $this->dropColumn('graduate', 'graduate_date');
    }
}