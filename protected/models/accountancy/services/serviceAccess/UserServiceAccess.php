<?php

/**
 * This is the model class for table "user_service_access".
 *
 * The followings are the available columns in table 'user_service_access':
 * @property integer $userId
 * @property integer $serviceId
 * @property string $endDate
 * @property integer $userChanged
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property $CourseService $courseService
 * @property $ModuleService $moduleService
 * @property $Course $course
 * @property $Module $module
 * @property StudentReg $user
 * @property StudentReg $changedUser
 *
 */
class UserServiceAccess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_service_access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, serviceId, endDate, userChanged', 'required'),
			// The following rule is used by search().
			array('userId, serviceId, endDate, userChanged, comment', 'safe', 'on'=>'search'),
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
            'courseService' => array(self::BELONGS_TO, 'CourseService', ['serviceId'=>'service_id']),
            'course' => array(self::BELONGS_TO, 'Course', array('course_id'=>'course_ID'), 'through' => 'courseService'),
            'moduleService' => array(self::BELONGS_TO, 'ModuleService', ['serviceId'=>'service_id']),
            'module' => array(self::BELONGS_TO, 'Module', array('module_id'=>'module_ID'), 'through' => 'moduleService'),
            'user' => array(self::BELONGS_TO, 'StudentReg', 'userId'),
            'changedUser' => array(self::BELONGS_TO, 'StudentReg', 'userChanged'),
            'agreement' => array(self::BELONGS_TO, 'UserAgreements', ['serviceId'=>'service_id','userId'=>'user_id']),
			'invoices' => array(self::HAS_MANY, 'Invoice', array('id'=>'agreement_id'), 'through' => 'agreement'),
			'internalPayment' => array(self::HAS_MANY, 'InternalPays', array('id'=>'invoice_id'), 'through' => 'invoices')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userId' => 'Ід користувача',
			'serviceId' => 'Ід сервіса',
            'endDate' => 'Дата закінчення доступу',
            'userChanged' => 'Ким нараховано',
            'comment' => 'Коментар'
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

		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('serviceId',$this->serviceId);
        $criteria->compare('endDate', $this->endDate);
        $criteria->compare('userChanged',$this->userChanged,true);
		$criteria->compare('comment',$this->comment);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserServiceAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function primaryKey() {
        return array('userId', 'serviceId');
    }
}
