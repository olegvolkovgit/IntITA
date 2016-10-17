<?php

/**
 * This is the model class for table "user_blocked".
 *
 * The followings are the available columns in table 'user_blocked':
 * @property integer $id_user
 * @property integer $locked_by
 * @property string $locked_date
 * @property integer $unlocked_by
 * @property string $unlocked_date
 *
 * The followings are the available model relations:
 * @property User $idUser
 */
class UserBlocked extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_blocked';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, locked_by', 'required'),
			array('id_user, locked_by, unlocked_by', 'numerical', 'integerOnly'=>true),
			array('locked_date, unlocked_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, locked_by, locked_date, unlocked_by, unlocked_date', 'safe', 'on'=>'search'),
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
			'registeredUser' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
			'lockedBy' => array(self::BELONGS_TO, 'StudentReg', ['locked_by'=>'id']),
			'unlockedBy' => array(self::BELONGS_TO, 'StudentReg', ['unlocked_by'=>'id']),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'locked_by' => 'Locked By',
			'locked_date' => 'Locked Date',
			'unlocked_by' => 'Unlock By',
			'unlocked_date' => 'Unlocked Date',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('locked_by',$this->locked_by);
		$criteria->compare('locked_date',$this->locked_date,true);
		$criteria->compare('unlocked_by',$this->unlocked_by);
		$criteria->compare('unlocked_date',$this->unlocked_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserBlocked the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
