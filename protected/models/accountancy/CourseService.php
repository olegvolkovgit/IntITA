<?php

/**
 * This is the model class for table "acc_course_service".
 *
 * The followings are the available columns in table 'acc_course_service':
 * @property string $service_id
 * @property integer $course_id
 */
class CourseService extends AbstractIntITAService
{
    public $course;
    public $service;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_course_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, course_id', 'required'),
			array('course_id', 'numerical', 'integerOnly'=>true),
			array('service_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('service_id, course_id', 'safe', 'on'=>'search'),
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
			'service_id' => 'Service',
			'course_id' => 'Course',
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

		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('course_id',$this->course_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CourseService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function primaryKey() {
        return 'course_id';
    }

    protected function primaryKeyValue()
    {
        return $this->course_id;
    }

    protected function descriptionFormatted()
    {
        return "Курс ".$this->course->title_ua." ";
    }

    protected function mainModel()
    {
        return Course::model();
    }

    public static function getService($idCourse)
    {
        return parent::getService(__CLASS__,"course_id",$idCourse);
    }

    protected function setMainModel($course)
    {
        if( $courseService = CourseService::model()->findByAttributes(array('course_id' => $course->course_ID))){
            $this->service = Service::model()->findByPk($courseService->service_id);
        }
        $this->course = $course;
    }

    public function getDuration()
    {
        return $this->course->getDuration();
    }

    public function getBillableObject(){
        if(!$this->course){
            $this->setModelIfNeeded();
        }
        return $this->course;
    }
}
