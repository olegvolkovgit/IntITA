<?php

/**
 * This is the model class for table "log_tracks".
 *
 * The followings are the available columns in table 'log_tracks':
 * @property integer $id
 * @property string $event
 * @property string $lesson
 * @property string $user
 * @property string $part
 * @property string $logtime
 */
class LogTracks extends CActiveRecord
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
			array('logtime', 'required'),
			array('event, lesson, user, part', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, event, lesson, user, part, logtime', 'safe', 'on'=>'search'),
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
			'event' => 'Event',
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
		$criteria->compare('event',$this->event,true);
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
	 * @return LogTracks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
