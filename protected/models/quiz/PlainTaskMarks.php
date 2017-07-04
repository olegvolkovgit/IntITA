<?php

/**
 * This is the model class for table "plain_task_marks".
 *
 * The followings are the available columns in table 'plain_task_marks':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_answer
 * @property integer $mark
 * @property string $comment
 * @property string $time
 * @property integer $read_mark
 * @property integer $marked_by
 *
 * The followings are the available model relations:
 * @property PlainTaskAnswer $taskAnswer
 */
class PlainTaskMarks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plain_task_marks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_answer, mark, read_mark', 'required'),
			array('id_user, id_answer, mark, read_mark, marked_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, id_user, id_answer, mark, comment, time, read_mark, marked_by', 'safe', 'on'=>'search'),
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
            'taskAnswer' => array(self::BELONGS_TO, 'PlainTaskAnswer', ['id_answer'=>'id']),
            'plainTask' => [
                self::BELONGS_TO,
                'PlainTask',
                ['id_plain_task' => 'id'],
                'through' => 'taskAnswer',
                ],
            'lectureElement' => [
                self::BELONGS_TO,
                'LectureElement',
                ['block_element' => 'id_block'],
                'through' => 'plainTask',
            ],
            'markedBy' => array(self::BELONGS_TO, 'StudentReg', array('marked_by'=>'id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_answer' => 'Id Plain Task Answer',
			'mark' => 'Mark',
			'comment' => 'Comment',
			'time' => 'Time',
			'read_mark' => 'Read mark',
			'marked_by' => 'Marked by',
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
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_answer',$this->id_answer);
		$criteria->compare('mark',$this->mark);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('read_mark',$this->read_mark,true);
		$criteria->compare('marked_by',$this->marked_by,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PlainTaskMarks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function isTaskDone($user, $idTask){
		$taskAnswers=PlainTaskAnswer::model()->findAllByAttributes(array('id_student'=>$user,'quiz_uid'=>$idTask));

		foreach ($taskAnswers as $taskAnswer) {
			$taskMark=PlainTaskMarks::model()->findByAttributes(array('id_user'=>$user,'id_answer'=>$taskAnswer->id));
			if(!$taskMark || ($taskMark && $taskMark->mark)){
				return true;
			}
		}
		return false;
    }

    public static function taskTime($user, $answer){
        if( PlainTaskMarks::model()->exists('id_user =:user and id_answer =:answer and mark = 1',
            array(':user' => $user, ':answer' => $answer))){
            return PlainTaskMarks::model()->findByAttributes(array('id_user' => $user,'id_answer' => $answer,'mark' => 1))->time;
        }else return false;
    }

    public static function saveMark($answerId, $mark, $comment, $userId)
    {
		$plainMark = PlainTaskMarks::model()->findByAttributes(array('id_user'=>$userId,'id_answer'=>$answerId));
        if(!$plainMark){
			$plainMark = new PlainTaskMarks();
		}

        $plainMark->comment = $comment;
        $plainMark->id_answer = (int)$answerId;
        $plainMark->id_user = (int)$userId;
        $plainMark->mark = (int)$mark;
		$plainMark->marked_by = Yii::app()->user->getId();
		
        if($plainMark->save())
            return true;
        else return false;

    }
}
