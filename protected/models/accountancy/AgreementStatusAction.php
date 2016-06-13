<?php

/**
 * This is the model class for table "acc_agreement_status_action".
 *
 * The followings are the available columns in table 'acc_agreement_status_action':
 * @property integer $agreement
 * @property string $date
 * @property integer $user
 * @property integer $new_status
 *
 * The followings are the available model relations:
 * @property UserAgreementStatus $newStatus
 * @property UserAgreements $agreement0
 * @property StudentReg $user0
 */
class AgreementStatusAction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_agreement_status_action';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agreement, date, user, new_status', 'required'),
			array('agreement, user, new_status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('agreement, date, user, new_status', 'safe', 'on'=>'search'),
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
			'newStatus' => array(self::BELONGS_TO, 'UserAgreementStatus', 'new_status'),
			'agreement0' => array(self::BELONGS_TO, 'UserAgreements', 'agreement'),
			'user0' => array(self::BELONGS_TO, 'StudentReg', 'user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'agreement' => 'Agreement',
			'date' => 'Date',
			'user' => 'User',
			'new_status' => 'New Status',
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

		$criteria->compare('agreement',$this->agreement);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('user',$this->user);
		$criteria->compare('new_status',$this->new_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AgreementStatusAction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
