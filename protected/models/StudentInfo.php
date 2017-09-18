<?php

/**
 * This is the model class for table "student_info".
 *
 * The followings are the available columns in table 'student_info':
 * @property integer $id
 * @property integer $id_student
 * @property string $first_name
 * @property string $second_name
 * @property string $middle_name
 * @property string $birthday
 * @property string $mobile_phone
 * @property string $mobile_phone_2
 * @property string $email
 * @property string $email_intita
 * @property string $address
 * @property string $family_status_children
 * @property string $facebook
 * @property string $notes
 * @property string $education
 * @property string $source_about_us
 * @property string $interests
 * @property string $current_job
 * @property string $prev_job
 * @property string $english_level
 * @property integer $rather_form_study
 * @property integer $rather_time_study
 * @property string $rather_form_payment
 * @property integer $id_organization
 * @property integer $pay_form
 * @property string $debt_comment
 * @property string $time_call
 * @property string $date_converse
 * @property UserSpecializationOrganization[] $specializations
 *
 * The followings are the available model relations:
 * @property StudentReg $student
 * @property EducationForm $studyForm
 * @property EducationShift $studyTime
 * @property Graduate $graduate
 * @property OfflineGroups $group_name

 */
class StudentInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'student_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_student', 'required'),
			array('id_student, rather_form_study, rather_time_study, id_organization, pay_form', 'numerical', 'integerOnly'=>true),
			array('first_name, second_name, middle_name, email, email_intita, family_status_children, facebook, education, english_level, rather_form_payment, debt_comment', 'length', 'max'=>255),
			array('mobile_phone, mobile_phone_2', 'length', 'max'=>15),
			array('birthday, address, notes, source_about_us, interests, current_job, prev_job, time_call, date_converse', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_student, first_name, second_name, middle_name, birthday, mobile_phone, mobile_phone_2, email, email_intita, address, family_status_children, facebook, notes, education, source_about_us, interests, current_job, prev_job, english_level, rather_form_study, rather_time_study, rather_form_payment, id_organization, pay_form, debt_comment, time_call, date_converse', 'safe', 'on'=>'search'),
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
            'student' => array(self::BELONGS_TO, 'StudentReg', ['id_student'=>'id']),
            'studyForm' => array(self::BELONGS_TO, 'EducationForm', ['rather_form_study' => 'id']),
            'studyTime' => array(self::BELONGS_TO, 'EducationShift', ['rather_time_study' => 'id']),
            'payForm' => array(self::BELONGS_TO, 'SchemesName', ['pay_form' => 'pay_count']),
            'spec' => array(self::HAS_MANY, 'UserSpecializationOrganization', 'id_student_info'),
            'specializations'=>array(self::HAS_MANY,'SpecializationsGroup', array('id_specialization' => 'id'),'through'=>'spec'),
            'graduate' => array(self::BELONGS_TO, 'Graduate', [ 'id_student' => 'id_user' ]),
            'group' => array(self::HAS_MANY, 'OfflineStudents', ['id_user'=>'id_student']),
            'group_id' => array(self::HAS_MANY, 'OfflineSubgroups', ['id_subgroup'=>'id'], 'through'=>'group'),
            'group_name' => array(self::HAS_MANY, 'OfflineGroups', ['group'=>'id'], 'through'=>'group_id'),
            'cancel_name' => array(self::HAS_MANY, 'OfflineStudentCancelType', ['cancel_type'=>'id'], 'through'=>'group'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_student' => 'Id Student',
			'first_name' => 'First Name',
			'second_name' => 'Second Name',
			'middle_name' => 'Middle Name',
			'birthday' => 'Birthday',
			'mobile_phone' => 'Mobile Phone',
			'mobile_phone_2' => 'Mobile Phone 2',
			'email' => 'Email',
			'email_intita' => 'Email Intita',
			'address' => 'Address',
			'family_status_children' => 'Family Status Children',
			'facebook' => 'Facebook',
			'notes' => 'Notes',
			'education' => 'Education',
			'source_about_us' => 'Source About Us',
			'interests' => 'Interests',
			'current_job' => 'Current Job',
			'prev_job' => 'Prev Job',
			'english_level' => 'English Level',
			'rather_form_study' => 'Rather Form Study',
			'rather_time_study' => 'Rather Time Study',
			'rather_form_payment' => 'Rather Form Payment',
			'id_organization' => 'Id Organization',
            'pay_form' => 'Pay Form',
			'debt_comment' => 'Debt Comment',
			'time_call' => 'Time Call',
			'date_converse' => 'Date Converse',
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
		$criteria->compare('id_student',$this->id_student);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('second_name',$this->second_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('mobile_phone_2',$this->mobile_phone_2,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email_intita',$this->email_intita,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('family_status_children',$this->family_status_children,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('education',$this->education,true);
		$criteria->compare('source_about_us',$this->source_about_us,true);
		$criteria->compare('interests',$this->interests,true);
		$criteria->compare('current_job',$this->current_job,true);
		$criteria->compare('prev_job',$this->prev_job,true);
		$criteria->compare('english_level',$this->english_level,true);
		$criteria->compare('rather_form_study',$this->rather_form_study);
		$criteria->compare('rather_time_study',$this->rather_time_study);
		$criteria->compare('rather_form_payment',$this->rather_form_payment,true);
		$criteria->compare('id_organization',$this->id_organization);
		$criteria->compare('pay_form',$this->pay_form);
		$criteria->compare('debt_comment',$this->debt_comment,true);
		$criteria->compare('time_call',$this->time_call,true);
		$criteria->compare('date_converse',$this->date_converse,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StudentInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
