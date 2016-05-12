<?php

/**
 * This is the model class for table "task_marks".
 *
 * The followings are the available columns in table 'task_marks':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_task
 * @property integer $mark
 * @property string $result
 * @property string $warning
 * @property string $date
 * @property integer $uid
 *
 * The followings are the available model relations:
 * @property StudentReg $idUser
 */
class TaskMarks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task_marks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_task, mark, date, uid', 'required'),
			array('id_user, id_task, mark, uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_task, mark, result, warning, date, uid', 'safe', 'on'=>'search'),
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
			'idUser' => array(self::BELONGS_TO, 'User', 'id_user'),
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
			'result' => 'Result',
			'warning' => 'Warning',
			'date' => 'Date',
			'uid' => 'UID',
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
		$criteria->compare('result',$this->result,true);
		$criteria->compare('warning',$this->warning,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TaskMarks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function addMark($task, $status, $result='', $date, $warning=''){
        $model = new TaskMarks();

        $model->id_task = $task;
        $model->id_user = Yii::app()->user->getId();
        $model->mark = ($status == 'true')?1:0;
        $model->result = $result;
        $model->warning = $warning;
        $model->date = $date;
        if($model->save()){
			return true;
		};
    }

    public static function isTaskDone($user, $idTask){
        return TaskMarks::model()->exists('id_user =:user and id_task =:task and mark = 1',
            array(':user' => $user, ':task' => $idTask));
    }
	public static function taskTime($user, $idTask){
		if( TaskMarks::model()->exists('id_user =:user and id_task =:task and mark = 1',
			array(':user' => $user, ':task' => $idTask))){
			return TaskMarks::model()->findByAttributes(array('id_user' => $user,'id_task' => $idTask,'mark' => 1))->time;
		}else return false;
	}
}
