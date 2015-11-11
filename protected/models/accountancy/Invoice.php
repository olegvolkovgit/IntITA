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
 * @property string $pay_date
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
			array('user_created, summa, agreement_id', 'required'),
			array('agreement_id, user_created, user_cancelled', 'numerical', 'integerOnly'=>true),
			array('summa', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, agreement_id, date_created, date_cancelled, summa, payment_date, user_created, expiration_date,
			user_cancelled, pay_date', 'safe', 'on'=>'search'),
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
			'id' => 'Номер рахунка',
			'agreement_id' => 'Номер договору',
			'date_created' => 'Дата заведення',
			'date_cancelled' => 'Дата відміни',
			'summa' => 'Сума до сплати',
			'payment_date' => 'Оплатити до',
			'user_created' => 'Користувач',
			'expiration_date' => 'Дійсний до',
			'user_cancelled' => 'Хто відмінив',
            'pay_date' => 'Сплачено',
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
        $criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('user_created',$this->user_created);
		$criteria->compare('expiration_date',$this->expiration_date,true);
		$criteria->compare('user_cancelled',$this->user_cancelled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
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

        $model->payment_date = $paymentDate->format('Y-m-d H:i:s');
        $model->summa = $summa;
        $model->expiration_date = $paymentDate->modify(' +'.Config::getExpirationTimeInterval().' days')
            ->format('Y-m-d H:i:s');

        return $model;
    }

    public static function setInvoicesParamsAndSave($invoicesList, $user, $agreementId){

        foreach ($invoicesList as $invoice) {
            $invoice->user_created = $user;
            $invoice->agreement_id = $agreementId;
            $invoice->save();
        }
    }

    public static function getProductTitle($invoice){
        $service = null;
        if ($invoice->agreement_id != null){
            $agreement = UserAgreements::model()->findByPk($invoice->agreement_id);
            $service = AbstractIntitaService::getServiceById($agreement->service_id);

            var_dump($service);die;
        }
        return $service->getProductTitle();
    }

    public static function getInvoiceService(Invoice $invoice){

        return null;
    }

    public static function getPayLink($row,Invoice $data){
        $spanTagStart = '<span class="'.Invoice::getInvoiceStatus($data->id).'">';
        return $spanTagStart."Рахунок №".($row+1).". Сплатити ".
        number_format(PaymentHelper::getPriceUah($data->summa), 2, ",", " ")." грн. до ".
        date("d.m.y", strtotime($data->payment_date))."</span>";
    }

    public static function getInvoiceStatus($id){
        $model = Invoice::model()->findByPk($id);

        if (!empty($model->pay_date)){     // invoice payed
            return 'payed';
        } else {
            if(strtotime($model->payment_date) < time()){
                return 'waitPaymentDate';
            } else {
                if(time() > strtotime($model->expiration_date) ){
                    return 'overdue';     //expiration_date pass
                }else {
                    return 'waiting';     // wait paying
                }
            }
        }
    }
}
