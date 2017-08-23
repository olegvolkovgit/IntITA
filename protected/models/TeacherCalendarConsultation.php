<?php

/**
 * This is the model class for table "teacher_calendar_consultation".
 *
 * The followings are the available columns in table 'teacher_calendar_consultation':
 * @property integer $id
 * @property integer $teacher_id
 * @property integer $user_id
 * @property integer $lecture_id
 * @property string $start_time
 * @property string $end_time
 * @property integer $status
 * @property string $date
 * @property integer $year
 * @property integer $month
 * @property string $comment
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property StudentReg $teacher
 * @property StudentReg $student
 * @property Lecture $lecture
 */
class TeacherCalendarConsultation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher_calendar_consultation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year, month, teacher_id', 'required'),
			array('teacher_id, user_id, lecture_id', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>256),
			array('end_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, teacher_id, user_id, lecture_id, start_time, end_time, status, date, year, month, comment, create_date', 'safe', 'on'=>'search'),
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
			'teacher' => array(self::BELONGS_TO, 'StudentReg', 'teacher_id'),
			'student' => array(self::BELONGS_TO, 'StudentReg', 'user_id'),
            'lecture' => array(self::BELONGS_TO, 'Lecture', 'lecture_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'teacher_id' => 'Teacher',
            'user_id' => 'User',
            'lecture_id' => 'Lecture',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status' => 'Status',
            'date' => 'Date',
            'year' => 'Year',
            'month' => 'Month',
            'comment' => 'Comment',
            'create_date' => 'Create Date',
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
        $criteria->compare('teacher_id',$this->teacher_id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('lecture_id',$this->lecture_id);
        $criteria->compare('start_time',$this->start_time,true);
        $criteria->compare('end_time',$this->end_time,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('date',$this->date);
        $criteria->compare('year',$this->year);
        $criteria->compare('month',$this->month);
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherCalendarConsultation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getCalendarConsultation($id_teacher, $year, $month){
	    $result = array();
        $time_consultation = TeacherCalendarConsultation::model()->findAllByAttributes(array('year'=>$year, 'month'=>$month, 'teacher_id'=>$id_teacher),                                                                                             array('order'=>'start_time'));
        for($i = 0; $i<count($time_consultation);$i++){
            $result[$i]['id'] = $time_consultation[$i]->id;
            $result[$i]['year'] = $time_consultation[$i]->year;
            $result[$i]['month'] = $time_consultation[$i]->month;
            $result[$i]['start_time'] = $time_consultation[$i]->start_time;
            $result[$i]['end_time'] = $time_consultation[$i]->end_time;
            $result[$i]['comment'] = $time_consultation[$i]->comment;
            $result[$i]['date'] = $time_consultation[$i]->date;
            $result[$i]['status'] = $time_consultation[$i]->status;
            if( $time_consultation[$i]->student != NULL ){
                $result[$i]['student_name'] = $time_consultation[$i]->student->fullName;
                $result[$i]['student_id'] = $time_consultation[$i]->user_id;
            }
            if( $time_consultation[$i]->lecture != NULL ){
                $result[$i]['lecture_name'] = $time_consultation[$i]->lecture->title_ua;
            }
        }

        return json_encode($result);
    }

    /*Визначаєм клас комірки з інтервалом, натиснута чи не натиснута*/
    public static function classTD($teacher_id, $times, $date)
    {
        date_default_timezone_set('Europe/Kiev');
        $status = 1;
        $startTime = intval(substr($times, 0, 2)) * 60 + intval(substr($times, 3, 2));

        if ($date == date("Y-m-d")) {
            $start = substr($times, 0, 5);
            if ($start <= date("G:i")) {
                $classTD = 'disabledTime';
                return $classTD;
            }
        }
        $free_time = TeacherCalendarConsultation::model()->findAll("(date=:date and teacher_id=:teacher_id and status=:status)",
                                                                    array(':date' => $date, ':teacher_id' => $teacher_id, ':status' => $status));

        $classTD = 'disabledTime';
        foreach ($free_time as $td) {
            $startCons = intval(substr($td->start_time, 11, 2)) * 60 + intval(substr($td->start_time, 14, 2));
            $endCons = intval(substr($td->end_time, 11, 2)) * 60 + intval(substr($td->end_time, 14, 2));
            if($startTime >= $startCons && $startTime < $endCons)  {
                $classTD = '';
            }
        }
        return $classTD;
    }
}
