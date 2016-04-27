<?php


class TrackVideoModel extends CActiveRecord
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


	public function trackEvent($user,$lesson,$part)
	{
		$this->part =$part;
		$this->lesson = $lesson;
		$this->user =$user;
		$this->logtime = new CDbExpression('NOW()');
		$this->event_id = 7;
		$this->save();


	}
}
