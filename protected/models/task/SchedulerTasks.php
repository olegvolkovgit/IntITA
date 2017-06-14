<?php

/**
 * This is the model class for table "scheduler_tasks".
 *
 * The followings are the available columns in table 'scheduler_tasks':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $created_by
 * @property integer $repeat_type
 * @property string $start_time
 * @property string $end_time
 * @property integer $status 
 * @property integer $related_model_id
 * @property integer $id_organization
 * @property string $error
 */
class SchedulerTasks extends CActiveRecord implements ITask
{
    use loadFromRequest;

    /**
     * Statuses constant
     */
    const STATUSNEW = 1;
    const STATUSPROGRESS = 2;
    const STATUSOK = 3;
    const STATUSERROR = 4;
    const STATUSEDIT = 5;
    const STATUSCANCEL = 6;
    /**
     * Repeat task constant
     */
    const ONCETASK = 1;
    const DAILY = 2;
    const WEEKLY = 3;
    const MONTLY = 4;
    const YEARLY = 5;
    const WEEKDAYS =6 ;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'scheduler_tasks';
	}

	public function beforeValidate(){
	    if ($this->isNewRecord){
	        switch ($this->type){
                case TaskFactory::NEWSLETTER:
                    $this->name = 'Розсилка';
                    $this->status = $this::STATUSNEW;
            }
        }
        return parent::beforeValidate();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, created_by, id_organization','required'),
			array('type, repeat_type, status, created_by, related_model_id, id_organization', 'numerical', 'integerOnly'=>true),
			array('name, error', 'length', 'max'=>255),
			array('start_time, end_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type, repeat_type, start_time, end_time, status, error, created_by, related_model_id id_organization','safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::HAS_ONE, 'StudentReg', array('id'=>'created_by')),
            'newsletter'=>array(self::HAS_ONE, 'Newsletters', array('id'=>'related_model_id')),
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
			'status' => 'Status',
			'error' => 'Error',
			'related_model_id' => 'Ид связанной задачи',
			'id_organization' => 'Ид Организации',

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
		$criteria->compare('status',$this->status);
		$criteria->compare('related_model_id',$this->related_model_id);
		$criteria->compare('id_organization',$this->id_organization);
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
    /**
     * Returns model save restlt.
     * Params
     * model - Related model for create task .
     * type - Task type (see TaskFactory for avaliable types)
     * startTime - Date and time in mysql format when thi task will be start
     * repeatType - See constants in this class for availiable types (Default ONCETASK)
     */
	public function addTask($model, $type, $startTime, $repeatType = null){
        $this->type = $type;
        $this->created_by = Yii::app()->user->model->id;
        $this->status = SchedulerTasks::STATUSNEW;
        $repeatType ? $this->repeat_type=$repeatType : $this->repeat_type = SchedulerTasks::ONCETASK;
        $this->start_time = $startTime;
	    switch (get_class($model)){
            case "RevisionModule":
                $this->related_model_id = $model->id_module_revision;
                $this->id_organization = $model->getRelated('module')->id_organization;
                break;
            case "RevisionCourse":
                $this->related_model_id = $model->id_course_revision;
                $this->id_organization = $model->getRelated('course')->id_organization;
                break;
            default:
                $this->related_model_id = $model->id;
                $this->id_organization = $model->id_organization;
            break;
        }
        return $this->save();
    }

    public function run(){
        $task = TaskFactory::getInstance($this->type,$this->related_model_id);
        $task->run();
    }
}
