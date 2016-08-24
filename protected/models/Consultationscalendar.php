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
 * @property string $date_cancelled
 * @property integer $user_cancelled
 *
 * The followings are the available model relations:
 * @property StudentReg $user
 * @property StudentReg $teacher
 * @property Lecture $lecture
 * @property StudentReg $userCancelled
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

            array('id, teacher_id, user_id, lecture_id, start_cons, end_cons, date_cons, date_cancelled, user_cancelled',
                'safe', 'on' => 'search'),
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
            'user' => array(self::BELONGS_TO, 'StudentReg', 'user_id'),
            'teacher' => array(self::BELONGS_TO, 'StudentReg', 'teacher_id'),
            'lecture' => array(self::BELONGS_TO, 'Lecture', 'lecture_id'),
            'userCancelled' => array(self::BELONGS_TO, 'StudentReg', 'user_cancelled'),
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
            'date_cancelled' => 'Cancelled date',
            'user_cancelled' => 'User cancelled',
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
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('teacher_id', $this->teacher_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('lecture_id', $this->lecture_id);
        $criteria->compare('start_cons', $this->start_cons, true);
        $criteria->compare('end_cons', $this->end_cons, true);
        $criteria->compare('date_cons', $this->date_cons, true);
        $criteria->compare('date_cancelled', $this->date_cancelled, true);
        $criteria->compare('user_cancelled', $this->user_cancelled, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Consultationscalendar the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /*Визначаєм клас комірки з інтервалом, натиснута чи не натиснута*/
    public static function classTD($id, $times, $date)
    {
        date_default_timezone_set('Europe/Kiev');
        $startTime = intval(substr($times, 0, 2)) * 60 + intval(substr($times, 3, 2));
        if ($date == date("Y-m-d")) {
            $start = substr($times, 0, 5);
            if ($start <= date("G:i")) {
                $classTD = 'disabledTime';
                return $classTD;
            }
        }
        $a = Consultationscalendar::model()->findAll("(date_cons=:date and teacher_id=:id and date_cancelled IS NULL) or (date_cons=:date and user_id=:idu and date_cancelled IS NULL)", array(':date' => $date, ':id' => $id, ':idu' => Yii::app()->user->getId()));
        $classTD = '';
        foreach ($a as $td) {
            $startCons = intval(substr($td->start_cons, 0, 2)) * 60 + intval(substr($td->start_cons, 3, 2));
            $endCons = intval(substr($td->end_cons, 0, 2)) * 60 + intval(substr($td->end_cons, 3, 2));
            if ($startTime >= $startCons && $startTime < $endCons) {
                $classTD = 'disabledTime';
            }
        }
        return $classTD;
    }

    /*Визначаєм чи зайнятий час консультації перед збереженням*/
    public static function consultationFree($id, $times, $date)
    {
        $a = Consultationscalendar::model()->findAll("date_cons=:date and teacher_id=:id and date_cancelled IS NULL", array(':date' => $date, ':id' => $id));
        $result = true;
        $startTime = intval(substr($times, 0, 2)) * 60 + intval(substr($times, 3, 2));
        $endTime = intval(substr($times, 6, 2)) * 60 + intval(substr($times, 9, 2));
        foreach ($a as $td) {
            $startCons = intval(substr($td->start_cons, 0, 2)) * 60 + intval(substr($td->start_cons, 3, 2));
            $endCons = intval(substr($td->end_cons, 0, 2)) * 60 + intval(substr($td->end_cons, 3, 2));
            if (($startTime >= $startCons && $startTime < $endCons) || ($startCons >= $startTime && $startCons < $endTime) || ($endCons > $startTime && $endCons <= $endTime)) {
                $result = false;
            }
        }
        return $result;
    }

    /*значення таблиці з интервалом 20хв в ширину 3*/
    public static function timeInterval($a, $b, $c)
    {
        $delta = 60 / $c;

        $t1 = $a + intval($b / $delta);
        $t2 = $b * $c;
        $t3 = $a + intval(($b + 1) / $delta);
        $t4 = ($b + 1) * $c;
        if ($t4 == 60) $t4 = 0;

        if (strlen(strval($t1)) == 1) $t1 = '0' . $t1;
        if (strlen(strval($t2)) == 1) $t2 = '0' . $t2;
        if (strlen(strval($t3)) == 1) $t3 = '0' . $t3;
        if (strlen(strval($t4)) == 1) $t4 = '0' . $t4;

        $t = $t1 . ':' . $t2 . '-' . $t3 . ':' . $t4;
        return $t;
    }

    public function deleteConsultation(RegisteredUser $user)
    {
        if ($this->user_id == $user->registrationData->id) {
            if ($this->cancel()) return true;
        } else {
            if ($user->isTeacher() && $user->id == $this->teacher_id) {
                if ($this->cancel()) return true;
            }
        }
        return false;
    }

    private function cancel(){
        date_default_timezone_set(Config::getServerTimezone());
        if(!$this->isCancelled()) {
            $this->user_cancelled = Yii::app()->user->getId();
            $this->date_cancelled = date("Y-m-d H:i:s");
            if ($this->save()) {
                $this->user->notify('student/_cancelConsultation', array($this), 'Скасовано консультацію');
                $this->teacher->notify('consultant/_cancelConsultation', array($this), 'Скасовано консультацію');
                return true;
            }
        }
        return false;
    }

    public static function todayConsultationsList($teacher)
    {
        date_default_timezone_set('Europe/Kiev');
        $currentDate = new DateTime();
        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.start_cons, cs.end_cons from consultations_calendar cs
                left join user u on u.id=cs.user_id
                 left join lectures l on l.id = cs.lecture_id where cs.teacher_id=' . $teacher . ' and cs.date_cancelled IS NULL   and
                 cs.date_cons BETWEEN STR_TO_DATE(\'' . date_format($currentDate, "Y-m-d 00:00:00") . '\', \'%Y-%m-%d %H:%i:%s\')
                    AND STR_TO_DATE(\'' . date_format($currentDate, "Y-m-d 23:59:59") . '\', \'%Y-%m-%d %H:%i:%s\')';

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["user"]["name"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"]["name"] = ($record["title_ua"] != "") ? $record["title_ua"] : "лекція видалена";
            $row["date_cons"] = date("d.m.Y", strtotime($record["date_cons"]));
            $row["start_cons"] = $record["start_cons"];
            $row["end_cons"] = $record["end_cons"];
            $row["user"]["url"] = $row["lecture"]["url"] = Yii::app()->createUrl('/_teacher/_consultant/consultant/consultation/', array('id' => $record["cons_id"]));
            if(date('H:i') > date('H:i',strtotime($record["end_cons"]))){
                $row["start"]["status"] = 'ended';
            } else {
                if(date('H:i') > date('H:i', strtotime($record["start_cons"]))) {
                    $row["start"]["status"] = 'started';
                    $row["start"]["link"] = Config::getBaseUrl() . '/crmChat/#/consultation_view/' . $record['cons_id'];
                } else {
                    $row["start"]["status"] = 'wait';
                }
            }
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function plannedConsultationsList($teacher)
    {
        $currentDate = new DateTime();
        $currentDate->modify('+ 1 days');
        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.start_cons, cs.end_cons from consultations_calendar cs
                left join user u on u.id=cs.user_id
                 left join lectures l on l.id = cs.lecture_id where cs.teacher_id=' . $teacher . ' and cs.date_cancelled IS NULL   and
                 cs.date_cons BETWEEN STR_TO_DATE(\'' . date_format($currentDate, "Y-m-d 00:00:00") . '\', \'%Y-%m-%d %H:%i:%s\')
                    AND STR_TO_DATE(\'3000-01-01 23:59:59\', \'%Y-%m-%d %H:%i:%s\')';

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["user"]["name"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"]["name"] = ($record["title_ua"] != "") ? $record["title_ua"] : "лекція видалена";
            $row["date_cons"] = date("d.m.Y", strtotime($record["date_cons"]));
            $row["start_cons"] = $record["start_cons"];
            $row["end_cons"] = $record["end_cons"];
            $row["user"]["url"] = $row["lecture"]["url"] = Yii::app()->createUrl('/_teacher/_consultant/consultant/consultation/', array('id' => $record["cons_id"]));
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function pastConsultationsList($teacher)
    {

        $currentDate = new DateTime();
        $currentDate->modify('- 1 days');
        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.start_cons, cs.end_cons from consultations_calendar cs
                left join user u on u.id=cs.user_id
                 left join lectures l on l.id = cs.lecture_id where cs.teacher_id=' . $teacher . ' and cs.date_cancelled IS NULL  and
                 cs.date_cons BETWEEN STR_TO_DATE(\'0000-00-00 23:59:59\', \'%Y-%m-%d %H:%i:%s\') AND
                 STR_TO_DATE(\'' . date_format($currentDate, "Y-m-d 00:00:00") . '\', \'%Y-%m-%d\')';

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["user"]["name"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"]["name"] = ($record["title_ua"] != "") ? $record["title_ua"] : "лекція видалена";
            $row["date_cons"] = date("d.m.Y", strtotime($record["date_cons"]));
            $row["start_cons"] = $record["start_cons"];
            $row["end_cons"] = $record["end_cons"];
            $row["user"]["url"] = $row["lecture"]["url"] = Yii::app()->createUrl('/_teacher/_consultant/consultant/consultation/', array('id' => $record["cons_id"]));
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function cancelConsultationsList($teacher)
    {

        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.date_cancelled,
                u2.firstName as cancel_first, u2.middleName as cancel_middle, u2.secondName as cancel_second from consultations_calendar cs
                left join user u on u.id=cs.user_id
                left join lectures l on l.id = cs.lecture_id
                left join user u2 on u2.id=cs.user_cancelled
                where cs.date_cancelled IS NOT NULL and cs.teacher_id='.$teacher;

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["user"]["name"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"]["name"] = ($record["title_ua"] != "") ? $record["title_ua"] : "лекція видалена";
            $row["date_cons"] = date("d.m.Y", strtotime($record["date_cons"]));
            $row["user_cancelled"] = $record["cancel_second"]." ".$record["cancel_first"]." ".$record["cancel_middle"];
            $row["date_cancelled"] = date("d.m.Y", strtotime($record["date_cancelled"]));
            $row["user"]["url"] = $row["lecture"]["url"] = Yii::app()->createUrl('/_teacher/_consultant/consultant/consultation/', array('id' => $record["cons_id"]));
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    // todo Add datetime filter for appearance of button start consultation (10 minutes interval for start/end consultation)
    public function isAvailable()
    {
        date_default_timezone_set(Config::getServerTimezone());
        //if lecture isn't cancelled
        if ($this->lecture) {
            //check if today
            if ((date('Y-m-d') == date('Y-m-d', strtotime($this->date_cons))) &&    //is today
                (date('H:i') < date('H:i',strtotime($this->end_cons))) && //is not ended
                (date('H:i') > date('H:i', strtotime($this->start_cons))) //is started
            ) {
                return true;
            }
        }
        return false;
    }

    public function isCanBeCancelled()
    {
        date_default_timezone_set('Europe/Kiev');
        if ($this->lecture) {
            $today = new DateTime();
            $match_date = DateTime::createFromFormat("Y-m-d", $this->date_cons);
            $diff = $today->diff($match_date);
            if ($diff->invert == 1) {
                return false;
            } else {
                if(date('H:i')>=date('H:i',strtotime($this->start_cons)))
                    return false;
                else return true;
            }
        }
        return false;
    }


    public static function studentTodayConsultationsList($user)
    {
        date_default_timezone_set('Europe/Kiev');
        $currentDate = new DateTime();
        $sql = 'select cs.id cons_id, l.id, l.title_ua, l.idModule, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.start_cons, cs.end_cons from consultations_calendar cs
                left join user u on u.id=cs.teacher_id
                 left join lectures l on l.id = cs.lecture_id where cs.user_id=' . $user . ' and cs.date_cancelled IS NULL and
                 cs.date_cons BETWEEN STR_TO_DATE(\'' . date_format($currentDate, "Y-m-d 00:00:00") . '\', \'%Y-%m-%d %H:%i:%s\')
                    AND STR_TO_DATE(\'' . date_format($currentDate, "Y-m-d 23:59:59") . '\', \'%Y-%m-%d %H:%i:%s\')';

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $access=PayModules::model()->checkModulePermission($user, $record["idModule"], array('read'));
            $row = array();

            $row["user"]["name"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $title=($record["title_ua"] != "") ? $record["title_ua"] : "лекція видалена";
            if(!$access) $row["lecture"]["name"] = $title.' (доступ до заняття обмежений)';
            else $row["lecture"]["name"] = $title;
            $row["date_cons"] = date("d.m.Y", strtotime($record["date_cons"]));
            $row["start_cons"] = $record["start_cons"];
            $row["end_cons"] = $record["end_cons"];
            $row["user"]["url"] = $row["lecture"]["url"] = $access?Yii::app()->createUrl('/_teacher/_student/student/consultation/', array('id' => $record["cons_id"])):false;
            if(!$access){
                $row["start"]["status"] = 'false';
            }else if(date('H:i') > date('H:i',strtotime($record["end_cons"]))){
                $row["start"]["status"] = 'ended';
            } else {
                if(date('H:i') > date('H:i', strtotime($record["start_cons"]))) {
                    $row["start"]["status"] = 'started';
                    $row["start"]["link"] = Config::getBaseUrl() . '/crmChat/#/consultation_view/' . $record['cons_id'];
                } else {
                    $row["start"]["status"] = 'wait';
                }
            }
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function studentPlannedConsultationsList($user)
    {
        $currentDate = new DateTime();
        $currentDate->modify('+ 1 days');
        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.start_cons, cs.end_cons from consultations_calendar cs
                left join user u on u.id=cs.teacher_id
                 left join lectures l on l.id = cs.lecture_id where cs.user_id=' . $user . ' and cs.date_cancelled IS NULL and
                 cs.date_cons BETWEEN STR_TO_DATE(\'' . date_format($currentDate, "Y-m-d 00:00:00") . '\', \'%Y-%m-%d %H:%i:%s\')
                    AND STR_TO_DATE(\'3000-01-01 23:59:59\', \'%Y-%m-%d %H:%i:%s\')';

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["user"]["name"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"]["name"] = ($record["title_ua"] != "") ? $record["title_ua"] : "лекція видалена";
            $row["date_cons"] = date("d.m.Y", strtotime($record["date_cons"]));
            $row["start_cons"] = $record["start_cons"];
            $row["end_cons"] = $record["end_cons"];
            $row["user"]["url"] = $row["lecture"]["url"] = Yii::app()->createUrl('/_teacher/_student/student/consultation/', array('id' => $record["cons_id"]));
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function studentPastConsultationsList($user)
    {

        $currentDate = new DateTime();
        $currentDate->modify('- 1 days');
        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.start_cons, cs.end_cons from consultations_calendar cs
                left join user u on u.id=cs.teacher_id
                 left join lectures l on l.id = cs.lecture_id where cs.user_id=' . $user . ' and cs.date_cancelled IS NULL and
                 cs.date_cons BETWEEN STR_TO_DATE(\'0000-00-00 23:59:59\', \'%Y-%m-%d %H:%i:%s\') AND
                 STR_TO_DATE(\'' . date_format($currentDate, "Y-m-d 00:00:00") . '\', \'%Y-%m-%d\')';

        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["user"]["name"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"]["name"] = ($record["title_ua"] != "") ? $record["title_ua"] : "лекція видалена";
            $row["date_cons"] = date("d.m.Y", strtotime($record["date_cons"]));
            $row["start_cons"] = $record["start_cons"];
            $row["end_cons"] = $record["end_cons"];
            $row["user"]["url"] = $row["lecture"]["url"] = Yii::app()->createUrl('/_teacher/_student/student/consultation/', array('id' => $record["cons_id"]));
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public function isCancelled(){
        return ($this->date_cancelled != null)?true:false;
    }

    public static function studentCancelConsultationsList($student)
    {

        $sql = 'select cs.id cons_id, l.id, l.title_ua, u.secondName, u.firstName, u.middleName, u.email, cs.date_cons, cs.date_cancelled,
                u2.firstName as cancel_first, u2.middleName as cancel_middle, u2.secondName as cancel_second from consultations_calendar cs
                left join user u on u.id=cs.teacher_id
                left join lectures l on l.id = cs.lecture_id
                left join user u2 on u2.id=cs.user_cancelled
                where cs.date_cancelled IS NOT NULL and cs.user_id='.$student;

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());

        foreach ($result as $record) {
            $row = array();

            $row["user"]["name"] = implode(" ", array($record["secondName"], $record["firstName"], $record["middleName"], $record["email"]));
            $row["lecture"]["name"] = ($record["title_ua"] != "") ? $record["title_ua"] : "лекція видалена";
            $row["date_cons"] = date("d.m.Y", strtotime($record["date_cons"]));
            $row["user_cancelled"] = $record["cancel_second"]." ".$record["cancel_first"]." ".$record["cancel_middle"];
            $row["date_cancelled"] = date("d.m.Y", strtotime($record["date_cancelled"]));
            $row["user"]["url"] = $row["lecture"]["url"] = Yii::app()->createUrl('/_teacher/_student/student/consultation/', array('id' => $record["cons_id"]));
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }
}
