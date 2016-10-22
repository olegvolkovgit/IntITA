<?php

/**
 * This is the model class for table "user_super_visor".
 *
 * The followings are the available columns in table 'user_super_visor':
 * @property integer $id_user
 * @property string $start_date
 * @property string $end_date
 * @property integer $assigned_by
 * @property integer $cancelled_by
 *
 * The followings are the available model relations:
 * @property StudentReg $user
 */
class UserSuperVisor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_super_visor';
	}

    public function getRoleName()
    {
        return 'Supervisor';
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, assigned_by', 'required'),
			array('end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, start_date, end_date,assigned_by,cancelled_by', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
            'assigned_by_user' => array(self::BELONGS_TO, 'StudentReg', ['assigned_by'=>'id']),
            'cancelled_by_user' => array(self::BELONGS_TO, 'StudentReg',['cancelled_by'=>'id']),
		);
	}
	public function primaryKey()
	{
		return array('id_user', 'start_date');
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserSuperVisor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function superVisorsArray(){
        $criteria = new CDbCriteria();
        $criteria->distinct = true;
        $criteria->addCondition('end_date IS NULL');
		return UserSuperVisor::model()->with('user')->findAll($criteria);
	}

	public static function adminsData()
	{
		return;
	}
}