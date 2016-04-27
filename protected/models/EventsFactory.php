<?php

/**
 * This is the model class for table "log_tracks".
 *
 * The followings are the available columns in table 'log_tracks':
 * @property integer $id
 * @property integer $event_id
 * @property string $lesson
 * @property string $user
 * @property string $part
 * @property string $logtime
 *
 * The followings are the available model relations:
 * @property EventsName $event
 */
class EventsFactory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_tracks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, logtime', 'required'),
			array('event_id', 'numerical', 'integerOnly'=>true),
			array('lesson, user, part', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, event_id, lesson, user, part, logtime', 'safe', 'on'=>'search'),
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
			'event' => array(self::BELONGS_TO, 'EventsName', 'event_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'lesson' => 'Lesson',
			'user' => 'User',
			'part' => 'Part',
			'logtime' => 'Logtime',
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
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('lesson',$this->lesson,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('part',$this->part,true);
		$criteria->compare('logtime',$this->logtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EventsFactory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function TrackEvent($string)
	{

        switch($string) {
            case 'Start_Video':
				return new TrackVideoModel();
            case 'LogIn':
                return new TrackLogInModel();
            case 'LogOut':
                return new TrackLogOutModel();
            case 'Open_Quiz':
                return new TrackOpenQuizModel();
            case 'Open_Text':
                return new TrackOpenTextModel();
            case 'TrueAnswer':
                return new TrackTrueQuizModel();
            case 'FalseAnswer':
                return new TrackFalseQuizModel();

    }
	}
}
