<?php

/**
 * This is the model class for table "skip_task_marks".
 *
 * The followings are the available columns in table 'skip_task_marks':
 * @property integer $id
 * @property integer $user
 * @property integer $id_task
 * @property integer $mark
 * @property string $time
 * @property integer $quiz_uid
 *
 * The followings are the available model relations:
 * @property SkipTask $idTask
 * @property StudentReg $user0
 */
class SkipTaskMarks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'skip_task_marks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, id_task, mark, quiz_uid', 'required'),
			array('user, id_task, mark, quiz_uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, id_task, mark, time, quiz_uid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idTask' => array(self::BELONGS_TO, 'SkipTask', 'id_task'),
			'user0' => array(self::BELONGS_TO, 'User', 'user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'User',
			'id_task' => 'Id Task',
			'mark' => 'Mark',
			'time' => 'Time',
            'quiz_uid' => 'quiz_uid'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user',$this->user);
		$criteria->compare('id_task',$this->id_task);
		$criteria->compare('mark',$this->mark);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('quiz_uid',$this->quiz_uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SkipTaskMarks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function isTaskDone($user, $idTask)
    {
        return SkipTaskMarks::model()->exists('user =:user and quiz_uid =:task and mark = 1',
            array(':user' => $user, ':task' => $idTask));
    }

    public static function marksAnswer($quizId,$answers)
    {

        $isDone = true;
        $mark = 0;
        $skipTask = SkipTask::model()->findByAttributes(array('condition' => $quizId));
        $skipTaskAnswers = SkipTask::model()->findByAttributes(array('condition' => $quizId))->skipTaskAnswers;

        usort($skipTaskAnswers, function($a, $b)
        {
            return strcmp($a->answer_order, $b->answer_order);
        });

        for($i = 0;$i < count($skipTaskAnswers);$i++)
        {
            $answer = $answers[$i][0];
            $taskAnswer = $skipTaskAnswers[$i]->answer;
            if($answers[$i][2] == 1)
            {
                $answer = mb_convert_case($answer, MB_CASE_UPPER, "UTF-8");
                $taskAnswer = mb_convert_case($taskAnswer, MB_CASE_UPPER, "UTF-8");
            }

            if(strcmp($answer,$taskAnswer) != 0)
            {
                $mark= 0;
                $isDone = false;
                break;
            }
            else
            {
                $mark = 1;
            }
        }
        $skipTaskMarks = new SkipTaskMarks();
        $skipTaskMarks->mark = $mark;
        $skipTaskMarks->user =(int)Yii::app()->user->id;
        $skipTaskMarks->id_task = $skipTask->id;
        $skipTaskMarks->quiz_uid = $skipTask->uid;
        $skipTaskMarks->save();

        return $isDone;

    }
	public static function taskTime($user, $idTest){
		if(SkipTaskMarks::model()->exists('user =:user and quiz_uid =:task and mark = 1',
			array(':user' => $user, ':task' => $idTest))){
			return SkipTaskMarks::model()->findByAttributes(array('user' => $user,'quiz_uid' => $idTest,'mark' => 1))->time;
		}else return false;
	}
}
