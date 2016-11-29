<?php

/**
 * This is the model class for table "acc_course_service".
 *
 * The followings are the available columns in table 'acc_course_service':
 * @property string $service_id
 * @property integer $course_id
 * @property integer $education_form
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property Course $course
 * @property EducationForm $educForm
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
			array('service_id, course_id, education_form', 'required'),
			array('service_id, course_id, education_form', 'numerical', 'integerOnly'=>true),
			array('service_id', 'length', 'max'=>10),
			// The following rule is used by search().
			array('service_id, course_id, education_form', 'safe', 'on'=>'search'),
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
            'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
            'courseModel' => array(self::BELONGS_TO, 'Course', 'course_id'),
            'educForm' => array(self::BELONGS_TO, 'EducationForm', 'education_form')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'service_id' => 'Сервис',
			'course_id' => 'Курс',
            'education_form' => 'Форма навчання'
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

		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('course_id',$this->course_id);
        $criteria->compare('education_form', $this->education_form);

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
        return array('course_id', 'education_form');
    }

    protected function primaryKeyValue()
    {
        return $this->course_id;
    }

    protected function descriptionFormatted()
    {
        return "Курс ".$this->course->title_ua." (".$this->educForm->title_ua.")";
    }

    protected function mainModel()
    {
        return Course::model();
    }

    public static function getService($idCourse, EducationForm $educForm)
    {
        return parent::getService(__CLASS__,"course_id",$idCourse, $educForm);
    }

    protected function setMainModel($course,  $educForm)
    {
        if( $courseService = CourseService::model()->findByAttributes(array('course_id' => $course->course_ID,'education_form'=>$educForm))){
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

    public function getProductTitle(){
        if(!$this->course){
            $this->setModelIfNeeded();
        }
        return "Курс №".$this->course->course_number.". ".$this->course->title_ua . ', '.
        $this->course->level();
    }

    public static function getAllCoursesList()
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'course_id';
        $criteria->mergeWith(array(
            'join' => 'LEFT JOIN acc_user_agreements ua ON ua.service_id = t.service_id',
            'condition' => 'ua.service_id = t.service_id'
        ));
        return CourseService::model()->findAll($criteria);
    }

    public function checkAccess($idModule)
    {

        $course = Course::model()->findByPk($this->course_id);
        if($course){
            $result = CourseModules::checkModuleInCourse($idModule,$course->course_ID);
                if($result)
                    return true;
        }
        return false;
    }

    public function getEducationForm(){
        return $this->educForm;
    }
}
