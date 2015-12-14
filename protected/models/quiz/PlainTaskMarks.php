<?php

/**
 * This is the model class for table "plain_task_marks".
 *
 * The followings are the available columns in table 'plain_task_marks':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_task
 * @property integer $mark
 * @property string $comment
 * @property string $time
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
			array('id_user, id_task, mark, time', 'required'),
			array('id_user, id_task, mark', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_task, mark, comment, time', 'safe', 'on'=>'search'),
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
			'id_task' => 'Id Task',
			'mark' => 'Mark',
			'comment' => 'Comment',
			'time' => 'Time',
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
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_task',$this->id_task);
		$criteria->compare('mark',$this->mark);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('time',$this->time,true);

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
        return PlainTaskMarks::model()->exists('id_user =:user and id_task =:task and mark = 1',
            array(':user' => $user, ':task' => $idTask));
    }

    public static function taskTime($user, $idTask){
        if( PlainTaskMarks::model()->exists('id_user =:user and id_task =:task and mark = 1',
            array(':user' => $user, ':task' => $idTask))){
            return PlainTaskMarks::model()->findByAttributes(array('id_user' => $user,'id_task' => $idTask,'mark' => 1))->time;
        }else return false;
    }

    public static function saveMark($plainTaskId,$mark,$comment,$userId)
    {
        $plainMark = new PlainTaskMarks();

        $plainMark->comment = $comment;
        $plainMark->id_task = (int)$plainTaskId;
        $plainMark->id_user = (int)$userId;
        $plainMark->mark = (int)$mark;
        $plainMark->time = time();

        if($plainMark->save())
            return true;
        else return false;

    }
}
