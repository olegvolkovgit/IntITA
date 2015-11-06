<?php

/**
 * This is the model class for table "acc_user_agreements".
 *
 * The followings are the available columns in table 'acc_user_agreements':
 * @property integer $id
 * @property integer $user_id
 * @property string $service_id
 * @property string $create_date
 * @property integer $approval_user
 * @property string $approval_date
 * @property integer $cancel_user
 * @property string $cancel_date
 * @property string $close_date
 * @property string $payment_schema
 *
 * @property Service $service
 */
class UserAgreements extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_user_agreements';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, service_id, create_date, payment_schema', 'required'),
			array('user_id, approval_user, cancel_user', 'numerical', 'integerOnly'=>true),
			array('service_id, payment_schema', 'length', 'max'=>10),
			array('approval_date, cancel_date, close_date', 'safe'),
			// The following rule is used by search().
			array('id, user_id, service_id, create_date, approval_user, approval_date, cancel_user, cancel_date,
			close_date, payment_schema', 'safe', 'on'=>'search'),
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
            'service' => array(self::BELONGS_TO, 'Service', 'service_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'User account',
            'user_id' => 'User which have agreement',
            'service_id' => 'Service for this agreement',
            'create_date' => 'Create Date',
            'approval_user' => 'user who underscribe agreement',
            'approval_date' => 'date when agreement was approved',
            'cancel_user' => 'Is agreement cancelled',
            'cancel_date' => 'date when agreement was cancelled',
            'close_date' => 'Date when agreement should be closed',
            'payment_schema' => 'Payment scheme',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('approval_user',$this->approval_user);
		$criteria->compare('approval_date',$this->approval_date,true);
		$criteria->compare('cancel_user',$this->cancel_user);
		$criteria->compare('cancel_date',$this->cancel_date,true);
		$criteria->compare('close_date',$this->close_date,true);
		$criteria->compare('payment_schema',$this->payment_schema,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAgreements the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function addNewAgreement(){

    }
}
