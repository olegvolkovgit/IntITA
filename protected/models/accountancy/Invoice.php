<?php

/**
 * This is the model class for table "acc_invoice".
 *
 * The followings are the available columns in table 'acc_invoice':
 * @property integer $id
 * @property integer $agreement_id
 * @property string $date_created
 * @property string $date_cancelled
 * @property string $summa
 * @property string $payment_date
 * @property integer $user_created
 * @property string $expiration_date
 * @property integer $user_cancelled
 *
 * The followings are the available model relations:
 * @property UserAgreements $agreement
 * @property StudentReg $userCreated
 * @property StudentReg $userCancelled
 */
class Invoice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_created', 'required'),
			array('agreement_id, user_created, user_cancelled', 'numerical', 'integerOnly'=>true),
			array('summa', 'length', 'max'=>10),
			array('payment_date, expiration_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, agreement_id, date_created, date_cancelled, summa, payment_date, user_created, expiration_date, user_cancelled', 'safe', 'on'=>'search'),
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
			'agreement' => array(self::BELONGS_TO, 'UserAgreements', 'agreement_id'),
			'userCreated' => array(self::BELONGS_TO, 'User', 'user_created'),
			'userCancelled' => array(self::BELONGS_TO, 'User', 'user_cancelled'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'agreement_id' => 'Agreement',
			'date_created' => 'Date Created',
			'date_cancelled' => 'Date Cancelled',
			'summa' => 'Summa',
			'payment_date' => 'Payment Date',
			'user_created' => 'User Created',
			'expiration_date' => 'Expiration Date',
			'user_cancelled' => 'User Cancelled',
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
		$criteria->compare('agreement_id',$this->agreement_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_cancelled',$this->date_cancelled,true);
		$criteria->compare('summa',$this->summa,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('user_created',$this->user_created);
		$criteria->compare('expiration_date',$this->expiration_date,true);
		$criteria->compare('user_cancelled',$this->user_cancelled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Invoice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function createInvoice($summa,DateTime $paymentDate){
        $model = new Invoice();

        $model->date_created = time();
        $model->payment_date = $paymentDate;
        $model->summa = $summa;
        $model->expiration_date = $paymentDate->modify(' +'.Config::getExpirationTimeInterval().' days');

        return $model;
    }
}
