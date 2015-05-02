<?php

/**
 * This is the model class for table "consultationscalendar".
 *
 * The followings are the available columns in table 'consultationscalendar':
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
		return 'consultationscalendar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('teacher_id, user_id, lecture_id, start_cons, end_cons', 'required'),
//			array('teacher_id, user_id, lecture_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('lecture_id',$this->lecture_id);
		$criteria->compare('start_cons',$this->start_cons,true);
		$criteria->compare('end_cons',$this->end_cons,true);
        $criteria->compare('end_cons',$this->date_cons,true);

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

    public function classTD ($id, $times=0)
    {
        $a = Consultationscalendar::model()->find("teacher_id=:id", array(':id' => $id));

        return $times;
    }
    /*значення таблиці з интервалом 20хв в ширину 3*/
    public function timeInterval($a,$b,$c) {
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
}
