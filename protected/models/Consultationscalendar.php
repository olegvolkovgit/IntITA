<?php

/**
 * This is the model class for table "consultations_calendar".
 *
 * The followings are the available columns in table 'consultations_calendar':
 * @property integer $id
 * @property integer $teacher_id
 * @property integer $user_id
 * @property integer $lecture_id
 * @property string $start_cons
 * @property string $end_cons
 * @property string $date_cons
 */
class Consultationscalendar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consultations_calendar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('id, teacher_id, user_id, lecture_id, start_cons, end_cons, date_cons', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'teacher_id' => 'Teacher',
			'user_id' => 'User',
			'lecture_id' => 'Lecture',
			'start_cons' => 'Start Cons',
			'end_cons' => 'End Cons',
            'date_cons' => 'Date Cons',
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
		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('lecture_id',$this->lecture_id);
		$criteria->compare('start_cons',$this->start_cons,true);
		$criteria->compare('end_cons',$this->end_cons,true);
        $criteria->compare('date_cons',$this->date_cons,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Consultationscalendar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /*Визначаєм клас комірки з інтервалом, натиснута чи не натиснута*/
    public static function classTD ($id, $times, $date)
    {
        date_default_timezone_set('Europe/Kiev');
        $startTime = intval(substr($times, 0, 2))*60 + intval(substr($times, 3, 2));
        if($date == date("Y-m-d")) {
            $start = substr($times, 0, 5);
            if($start<=date("G:i")){
                $classTD='disabledTime';
                return $classTD;
            }
        }
        $a = Consultationscalendar::model()->findAll("(date_cons=:date and teacher_id=:id) or (date_cons=:date and user_id=:idu)", array(':date'=>$date, ':id' => $id, ':idu' => Yii::app()->user->getId()));
        $classTD = '';
        foreach($a as $td){
            $startCons = intval(substr($td->start_cons, 0, 2))*60 + intval(substr($td->start_cons, 3, 2));
            $endCons = intval(substr($td->end_cons, 0, 2))*60 + intval(substr($td->end_cons, 3, 2));
            if( $startTime>=$startCons && $startTime<$endCons){
                $classTD='disabledTime';
            }
        }
        return $classTD;
     }

    /*Визначаєм чи зайнятий час консультації перед збереженням*/
    public static function consultationFree ($id, $times, $date)
    {
        $a = Consultationscalendar::model()->findAll("date_cons=:date and teacher_id=:id", array(':date'=>$date, ':id' => $id));
        $result = true;
        $startTime = intval(substr($times, 0, 2))*60 + intval(substr($times, 3, 2));
        $endTime = intval(substr($times, 6, 2))*60 + intval(substr($times, 9, 2));
        foreach($a as $td){
            $startCons = intval(substr($td->start_cons, 0, 2))*60 + intval(substr($td->start_cons, 3, 2));
            $endCons = intval(substr($td->end_cons, 0, 2))*60 + intval(substr($td->end_cons, 3, 2));
            if( ($startTime>=$startCons && $startTime<$endCons) || ($startCons>=$startTime && $startCons<$endTime)|| ($endCons>$startTime && $endCons<=$endTime)){
                $result = false;
            }
        }
        return $result;
    }

    /*значення таблиці з интервалом 20хв в ширину 3*/
    public static function timeInterval($a,$b,$c) {
        $delta=60/$c;

        $t1=$a+intval($b/$delta);
        $t2=$b*$c;
        $t3=$a+intval(($b+1)/$delta);
        $t4=($b+1)*$c;
        if($t4==60) $t4=0;

        if(strlen(strval($t1))==1) $t1='0'.$t1;
        if(strlen(strval($t2))==1) $t2='0'.$t2;
        if(strlen(strval($t3))==1) $t3='0'.$t3;
        if(strlen(strval($t4))==1) $t4='0'.$t4;

        $t=$t1.':'.$t2.'-'.$t3.':'.$t4;
        return $t;
    }

    public function deleteConsultation(RegisteredUser $user)
    {
        if ($this->user_id==$user->registrationData->id) {
            if($this->delete()) return true;
        }else{
            if($user->isTeacher() && $user->id==$this->teacher_id){
                if($this->delete()) return true;
            }
        }
    }

	public static function consultationsList($teacher){

        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.start_cons, cs.end_cons from consultations_calendar cs
                left join user u on u.id=cs.user_id
                 left join lectures l on l.id = cs.lecture_id where cs.teacher_id='.$teacher;

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["username"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"] = ($record["title_ua"] != "")?$record["title_ua"]:"лекція видалена";
            $row["date_cons"] = date("d.m.Y",strtotime($record["date_cons"]));
            $row["start_cons"] = $record["start_cons"];
            $row["end_cons"] = $record["end_cons"];
            $row["url"] = Yii::app()->createUrl('/_teacher/_consultant/consultant/cancelConsultation/', array('id' => $record["cons_id"]));
            array_push($return['data'], $row);
        }

        return json_encode($return);
	}

    public static function studentConsultationsList($user){

        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.start_cons, cs.end_cons from consultations_calendar cs
                left join user u on u.id=cs.teacher_id
                 left join lectures l on l.id = cs.lecture_id where cs.user_id='.$user.' order by cs.id DESC';

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["username"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"] = ($record["title_ua"] != "")?$record["title_ua"]:"лекція видалена";
            $row["date_cons"] = date("d.m.Y",strtotime($record["date_cons"]));
            $row["start_cons"] = $record["start_cons"];
            $row["end_cons"] = $record["end_cons"];
            $row["url"] = Yii::app()->createUrl('/_teacher/_student/student/cancelConsultation/', array('id' => $record["cons_id"]));
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }
}
