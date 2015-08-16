<?php

/**
 * This is the model class for table "acc_payment_plan".
 *
 * The followings are the available columns in table 'acc_payment_plan':
 * @property string $agreement_id
 * @property string $pay_date
 * @property string $summa
 * @property string $paid_date
 * @property string $cancelled_date
 */
class AgreementPaymentPlan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_payment_plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agreement_id, pay_date, summa', 'required'),
			array('agreement_id, summa', 'length', 'max'=>10),
			array('paid_date, cancelled_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('agreement_id, pay_date, summa, paid_date, cancelled_date', 'safe', 'on'=>'search'),
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
			'agreement_id' => 'номер договору',
			'pay_date' => 'дата проплаты',
			'summa' => 'сумма проплаты',
			'paid_date' => 'дата проплати',
			'cancelled_date' => 'дата відміни',
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

		$criteria->compare('agreement_id',$this->agreement_id,true);
		$criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('summa',$this->summa,true);
		$criteria->compare('paid_date',$this->paid_date,true);
		$criteria->compare('cancelled_date',$this->cancelled_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AgreementPaymentPlan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
