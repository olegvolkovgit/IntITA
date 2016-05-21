<?php

/**
 * This is the model class for table "trainer_student".
 *
 * The followings are the available columns in table 'trainer_student':
 * @property integer $trainer
 * @property integer $student
 * @property string $start_time
 * @property string $end_time
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
			array('trainer, student', 'required'),
			array('trainer, student', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('trainer, student, start_time, end_time', 'safe', 'on'=>'search'),
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
            'trainer0' => array(self::BELONGS_TO, 'Teacher', 'trainer'),
            'trainerStudent' => array(self::HAS_MANY, 'StudentReg','id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'trainer' => 'Trainer',
			'student' => 'Student',
            'start_time' => 'Start time',
            'end_time' => 'End time'
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

		$criteria->compare('trainer',$this->trainer);
		$criteria->compare('student',$this->student);
        $criteria->compare('start_time',$this->start_time);
        $criteria->compare('end_time',$this->end_time);

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

    public function primaryKey(){
        return 'student';
    }

    public static function getStudentByTrainer($trainerId)
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'user';
        $criteria->join = 'INNER JOIN trainer_student on user.id = trainer_student.student';
        $criteria->addCondition('user.id = trainer_student.student');
        $criteria->condition = 'trainer = :trainer and end_time IS NULL';
        $criteria->params = array(':trainer' => $trainerId);

        $users = StudentReg::model()->findAll($criteria);

        return $users;
    }

	public static function getTrainerByStudent($trainerId)
	{
		$criteria = new CDbCriteria();
		$criteria->alias = 'user';
		$criteria->join = 'INNER JOIN trainer_student on user.id = trainer_student.trainer';
		$criteria->condition = 'student = :student and end_time IS NULL';
		$criteria->params = array(':student' => $trainerId);

		return StudentReg::model()->find($criteria);
	}
}
