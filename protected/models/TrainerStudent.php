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
			'student0' => array(self::BELONGS_TO, 'User', 'student'),
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

    public static function getStudentsByTrainer($trainer){
        $students = Yii::app()->db->createCommand(array(
            'select' => array('student'),
            'from' => 'trainer_student',
            'where' => 'trainer=:id',
            'order' => 'student',
            'params' => array(':id' => $trainer),
        ))->queryAll();
        $count = count($students);

        for($i = 0;$i < $count;$i++){
            $students[$i]['id'] = $students[$i]["student"];
            $students[$i]['title'] = StudentReg::model()->findByPk($students[$i]["student"])->firstName." ".
                StudentReg::model()->findByPk($students[$i]["id"])->secondName;
        }

        return (!empty($students))?$students:[];
    }

    public static function setRoleAttribute($teacher, $attribute, $value){
        $result = false;
        if (TrainerStudent::model()->exists('teacher=:teacher and student=:attribute', array('teacher'=>$teacher, 'attribute'=>$attribute))){
            $model = TrainerStudent::model()->findByAttributes(array('teacher'=>$teacher, 'student'=>$attribute));
        } else{
            $model = new TrainerStudent();
            $model->teacher = $teacher;
            $model->student = $attribute;
        }
        $model->value = $value;
        if ($model->validate()){
            $model->save();
            $result = true;
        }
        return $result;
    }

    public static function addTrainer($userId,$trainerId)
    {
        $trainerStudent = new TrainerStudent();

        $trainerStudent->student = $userId;
        $trainerStudent->trainer = $trainerId;
        if($trainerStudent->save())
            return true;
        else return false;
    }

    public static function editTrainer($userId,$trainerId)
    {
        $trainerStudent = TrainerStudent::model()->findByAttributes(array('student' => $userId));

        $trainerStudent->student = $userId;
        $trainerStudent->trainer = $trainerId;

        if($trainerStudent->save())
            return true;
        else return false;
    }

    public static function deleteUserTrainer($userId)
    {
        return TrainerStudent::model()->deleteAllByAttributes(array('student' => $userId));
    }

    public static function getTrainerStudents($teacher){
        $students = TrainerStudent::getStudentsByTrainer($teacher);
        $result = RoleAttribute::formatAttributeList($students, 'project/index', 'id', false);
        return $result;
    }
}
