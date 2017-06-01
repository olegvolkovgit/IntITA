<?php

class m170530_084107_move_graduates_to_intita_users extends CDbMigration
{

	public function up()
	{
//	    $this->addColumn('graduate','rate_id','INT(10) NOT NULL');
//	    $this->addColumn('graduate','published','TINYINT DEFAULT 0');
//	    $this->addColumn('rating_user_course','date_done','DATE DEFAULT NULL');
//	    $this->insert('config',[
//	        'param' => 'ratingScale',
//            'value' => 10,
//            'default'=>10,
//            'label' => 'Шкала оцінювання рейтингу студента'
//        ]);
        $graduates = Yii::app()->db->createCommand('SELECT graduate.id AS uid,
                                                           graduate.first_name, 
                                                           graduate.last_name, 
                                                           graduate.avatar, 
                                                           graduate.graduate_date, 
                                                           graduate.courses_page,  
                                                           graduate.rate,  
                                                           user.id 
                                                           FROM `graduate` 
                                                           LEFT JOIN user ON graduate.first_name = user.firstName AND graduate.last_name = user.secondName ')->queryAll();

        foreach ($graduates as $graduate){
            $uid = $graduate['uid'];

            if ($graduate['id']){
                $this->insert('rating_user_course',
                    [
                        'id_user' => $graduate['id'],
                        'id_course'=> $graduate['courses_page'],
                        'course_revision' => 1,
                        'rating' => round(((float)$graduate['rate']/10),2),
                        'date_done' => $graduate['graduate_date'],
                        'course_done'=>1
                    ]);
            }
            else{
                $this->insert('user',
                    [
                        'firstName' => $graduate['first_name'],
                        'secondName'=> $graduate['last_name'],
                        'avatar' => $graduate['avatar'],
                        'password' => sha1(microtime().'hdssdgcs'),
                        'cancelled'=>1
                    ]);
                $id = Yii::app()->db->createCommand('SELECT LAST_INSERT_ID()')->queryScalar();

                $this->insert('rating_user_course',
                    [
                        'id_user' => $id,
                        'id_course'=> $graduate['courses_page'],
                        'course_revision' => 1,
                        'rating' => round(((float)$graduate['rate']/10),2),
                        'date_done' => $graduate['graduate_date'],
                        'course_done'=>1
                    ]);

            }
            $rateId = Yii::app()->db->createCommand('SELECT LAST_INSERT_ID()')->queryScalar();

            $this->update('graduate',[
                'rate_id'=>$rateId,
                'published'=>1
            ],'id='.$uid);
        }
        $this->dropColumn('graduate','first_name');
        $this->dropColumn('graduate','last_name');
        $this->dropColumn('graduate','avatar');
        $this->dropColumn('graduate','graduate_date');
        $this->dropColumn('graduate','rate');
        $this->dropColumn('graduate','courses_page');
    }

	public function safeDown()
	{
	    echo "m170530_084107_move_graduates_to_intita_users does not support migration down.\n";
	    return false;
	}

}