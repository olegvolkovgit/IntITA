<?php

/**
 * This is the model class for table "scheduler_tasks".
 *
 * The followings are the available columns in table 'scheduler_tasks':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $repeat_type
 * @property string $start_time
 * @property string $end_time
 * @property string $parameters
 * @property integer $status
 * @property string $error
 */
class SchedulerTasks extends CActiveRecord implements ITask
{

    /**
     * Statuses constant
     */
    const STATUSNEW = 1;
    const STATUSPROGRESS = 2;
    const STATUSOK = 3;
    const STATUSERROR = 4;

    /**
     * Repeat task constant
     */
    const ONCETASK = 1;
    const DAILY = 2;
    const WEEKLY = 3;
    const MONTLY = 4;
    const YEARLY = 5;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'scheduler_tasks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, status', 'required'),
			array('type, repeat_type, status', 'numerical', 'integerOnly'=>true),
			array('name, error', 'length', 'max'=>255),
			array('start_time, end_time, parameters', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type, repeat_type, start_time, end_time, parameters, status, error', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'type' => 'Type',
			'repeat_type' => 'Repeat',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'parameters' => 'Parameters',
			'status' => 'Status',
			'error' => 'Error',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('repeat_type',$this->repeat_type);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('parameters',$this->parameters,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('error',$this->error,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SchedulerTasks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function run(){
        $task = TaskFactory::getInstance($this->type, $this->parameters);
        $task->run();
    }
}
