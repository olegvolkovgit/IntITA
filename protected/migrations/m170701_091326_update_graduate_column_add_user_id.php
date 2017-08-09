<?php

class m170701_091326_update_graduate_column_add_user_id extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('graduate','id_user','INT(10) NOT NULL');
        foreach (Graduate::model()->findAll() as $graduate){
            $this->update('graduate',[
                'id_user'=>RatingUserCourse::model()->find('id='.$graduate->rate_id)->id_user,
            ],'rate_id='.$graduate->rate_id);
        }
        $this->dropColumn('graduate','rate_id');
        $this->addForeignKey('FK_graduate_user', 'graduate', 'id_user', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_graduate_user', 'graduate');
        $this->addColumn('graduate','rate_id','INT(10) NOT NULL');
        foreach (Graduate::model()->findAll() as $graduate){
            $this->update('graduate',[
                'rate_id'=>RatingUserCourse::model()->find('id_user='.$graduate->id_user)->id,
            ],'id_user='.$graduate->id_user);
        }
        $this->dropColumn('graduate', 'id_user');
    }
}