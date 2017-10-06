<?php

/**
 * This is the model class for table "trainer_student".
 *
 * The followings are the available columns in table 'trainer_student':
 * @property integer $id
 * @property integer $trainer
 * @property integer $student
 * @property string $start_time
 * @property string $end_time
 * @property integer $id_organization
 *
 * The followings are the available model relations:
 * @property Teacher $trainer0
 * @property StudentReg $student0
 */
class TrainerStudent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'trainer_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trainer, student, id_organization', 'required'),
			array('trainer, student', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, trainer, student, start_time, end_time, id_organization', 'safe', 'on'=>'search'),
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
			'trainer0' => array(self::BELONGS_TO, 'Teacher', ['trainer'=>'user_id']),
            'trainerModel' => array(self::BELONGS_TO, 'StudentReg', 'trainer'),
            'trainerStudent' => array(self::HAS_MANY, 'StudentReg','id'),
			'studentModel' => array(self::BELONGS_TO, 'StudentReg', 'student'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'Id',
			'trainer' => 'Trainer',
			'student' => 'Student',
            'start_time' => 'Start time',
            'end_time' => 'End time',
			'id_organization' => 'Id Organization'
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
		$criteria->compare('trainer',$this->trainer);
		$criteria->compare('student',$this->student);
        $criteria->compare('start_time',$this->start_time);
        $criteria->compare('end_time',$this->end_time);
		$criteria->compare('id_organization',$this->id_organization);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TrainerStudent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getStudentByTrainer($trainerId)
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'user';
        $criteria->join = 'INNER JOIN trainer_student on user.id = trainer_student.student';
        $criteria->addCondition('user.id = trainer_student.student');
        $criteria->condition = 'trainer = :trainer and end_time IS NULL and trainer_student.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
        $criteria->params = array(':trainer' => $trainerId);

        $users = StudentReg::model()->findAll($criteria);

        return $users;
    }

	public static function getTrainerByStudent($studentId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = 'user.id, user.avatar, user.email, user.nickname, user.skype, user.phone, user.reg_time,user.firstName, user.middleName, user.secondName';
		$criteria->alias = 'user';
		$criteria->join = 'INNER JOIN trainer_student on user.id = trainer_student.trainer';
		$criteria->condition = 'student = :student and end_time IS NULL and trainer_student.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
		$criteria->params = array(':student' => $studentId);

		return StudentReg::model()->find($criteria);
	}

	public static function checkStudentInStudentInfo($id_student){
        $id_student = 3;
	    $check_student = StudentInfo::model()->findByAttributes(['id_student'=>$id_student]);
//	    var_dump(!isset($check_student));die;
	    if(!isset($check_student)){
            $student = StudentReg::model()->findByPk($id_student);

            $new_student = new StudentInfo();

//            $new_student->attributes = $student->attributes;      // works !!!
//            $new_student->first_name = $student['firstName'];
//            $new_student->second_name = $student['secondName'];
//            var_dump($new_student);die;

            $new_student->id_student = $student['id'];
            $new_student->first_name = $student['firstName'];
            $new_student->second_name = $student['secondName'];
            $new_student->middle_name = $student['middleName'];
            $new_student->birthday = $student['birthday'];
            $new_student->email = $student['email'];
            $new_student->mobile_phone = $student['phone'];
            $new_student->address = $student['address'];
            $new_student->facebook = $student['facebook'];
            $new_student->education = $student['education'];
            $new_student->interests = $student['interests'];
            $new_student->source_about_us = $student['aboutUs'];
            $new_student->prev_job = $student['prev_job'];
            $new_student->current_job = $student['current_job'];
            $new_student->rather_form_study = $student['educform'];
            $new_student->rather_time_study = $student['education_shift'];
            $new_student->id_organization = Yii::app()->user->model->getCurrentOrganization()->id;

            $new_student->save();
        }
    }
}
