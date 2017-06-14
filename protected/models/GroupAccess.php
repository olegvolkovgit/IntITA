<?php

/**
 * This is the model class for table "group_access_to_content".
 *
 * The followings are the available columns in table 'group_access_to_content':
 * @property integer $group_id
 * @property integer $service_id
 * @property string $start_date
 * @property string $end_date
 *
 * Relations
 * @property OfflineGroups $group
 * @property Course $course
 * @property Module $module
 */
class GroupAccess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'group_access_to_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, group_id, service_id', 'required'),
			// The following rule is used by search().
			array('start_date, end_date, group_id, service_id', 'safe', 'on'=>'search'),
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
			'group' => array(self::BELONGS_TO, 'OfflineGroups', ['group_id'=>'id']),
			'courseService' => array(self::BELONGS_TO, 'CourseService', ['service_id'=>'service_id']),
			'course' => array(self::BELONGS_TO, 'Course', array('course_id'=>'course_ID'), 'through' => 'courseService'),
			'moduleService' => array(self::BELONGS_TO, 'ModuleService', ['service_id'=>'service_id']),
			'module' => array(self::BELONGS_TO, 'Module', array('module_id'=>'module_ID'), 'through' => 'moduleService'),
			'service' => array(self::BELONGS_TO, 'Service', ['service_id'=>'service_id']),
		);
	}

	protected function beforeValidate()
	{
		if($this->group->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id){
			throw new \application\components\Exceptions\IntItaException(403, 'Ваші права не дозволяють змінювати модель в межах даної організації');
		}
		if($this->course && $this->course->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id){
			throw new \application\components\Exceptions\IntItaException(403, 'Ваші права не дозволяють змінювати модель в межах даної організації');
		}
		if($this->module && $this->module->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id){
			throw new \application\components\Exceptions\IntItaException(403, 'Ваші права не дозволяють змінювати модель в межах даної організації');
		}
		return parent::beforeValidate();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'group_id' => 'Id групи',
			'service_id' => 'Id сервісу',
			'start_date' => 'Дата початку доступу',
			'end_date' => 'Дата закінчення доступу',
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
		
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GroupAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function primaryKey(){
		return array('group_id', 'service_id');
	}
	
	public function getValidationErrors() {
		$errors=[];
		foreach($this->getErrors() as $key=>$attribute){
			foreach($attribute as $error){
				array_push($errors,$error);
			}
		}
		return implode(", ", $errors);
	}

}