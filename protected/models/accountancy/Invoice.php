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
			'userCreated' => array(self::BELONGS_TO, 'StudentReg', 'user_created'),
			'userCancelled' => array(self::BELONGS_TO, 'StudentReg', 'user_cancelled'),
            'internalPayment' => [self::HAS_ONE, 'InternalPays', '', 'on' => 't.id = internalPayment.invoice_id']
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

    public static function createInvoice($summa, DateTime $paymentDate){
        $model = new Invoice();
        $expirationDate = clone $paymentDate;
        $model->payment_date = $paymentDate->format('Y-m-d H:i:s');
        $model->summa = $summa;
        $interval = new DateInterval('P'.Config::getExpirationTimeInterval().'D');
        $model->expiration_date = $expirationDate->add($interval)->format('Y-m-d H:i:s');

        return $model;
    }

    public static function setInvoicesParamsAndSave($invoicesList, $user, $agreementId){

        foreach ($invoicesList as $key=>$invoice) {
            $invoice->user_created = $user;
            $invoice->agreement_id = $agreementId;
            $invoice->number = $agreementId .'/'. ($key + 1);
            $invoice->save();
        }
    }

    public static function getProductTitle($invoice){
        if ($invoice->agreement_id != null){
            $agreement = UserAgreements::model()->findByPk($invoice->agreement_id);
            return AbstractIntITAService::getServiceTitle($agreement->service_id);
        }
        return '';
    }

    public function isPayed()
    {
        return !empty($this->pay_date);
    }

    public function isWaitPaymentDate()
    {
        return (strtotime($this->payment_date) < time());
    }
    
    public function isOverdue()
    {
        return (time() > strtotime($this->expiration_date));
    }


    public function getUserName(){
        $user = $this->model()->userCreated;
        if($user) return $user->firstName.' '. $user->secondName;
        else return '';
    }

    public static function getAllInvoices(){
        return Invoice::model()->findAll();
    }

    public function getServiceDescription()
    {
        $agreement = $this->agreement;

        if ($agreement->service)
            return $agreement->service->description;
    }

    public static function getSumma($id){
        return Invoice::model()->findByPk($id)->summa;
    }

    public function description(){
        return "Paхунок ".$this->id." від ".date("d.m.y", strtotime($this->date_created)).". ";
    }

    public static function getInvoiceListById($invoicesListId){
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $invoicesListId);

        return Invoice::model()->findAll($criteria);
    }

    public static function getInvoicesByData($agreement,$number,$user,$course,$module)
    {
        $criteria = new CDbCriteria();

        if ($number != ""){
            $agr = UserAgreements::model()->findAllByPk($number);
            return $agr;
        }
        if ($user != ""){
            $criteria->addCondition('user_id='.$user, 'OR');
        }
        if ($course != ""){
            $service = CourseService::getService($course);
            $criteria->addCondition('service_id='.$service->service_id, 'OR');
        }
        if ($module != ""){
            $service = ModuleService::getService($module);
            $criteria->addCondition('service_id='.$service->service_id, 'OR');
        }

        return UserAgreements::model()->findAll($criteria);

    }

    public function getAgreementNumber()
    {
        return $this->agreement->number;
    }

    public static function findLikeInvoices($invoiceNumber)
    {
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('number', $invoiceNumber);
        $inv = Invoice::model()->findAll($criteria);
        return $inv;

    }

    public static function saveService($invoiceArr)
    {
        $userAgreement = UserAgreements::model()->findByPk($invoiceArr[0]->agreement_id);

        if($userAgreement->insertServiceUserData())
            return true;
        else return false;
    }

    public static function invoicesListByAgreement($agreement){
        $criteria = new CDbCriteria();
        $criteria->condition = 'agreement_id='.$agreement;

        $invoices = Invoice::model()->findAll($criteria);
        $return = array('data' => array());

        foreach ($invoices as $key=>$record) {
            $row = array();

            $row["title"]["name"] = "Рахунок №".($key + 1);
            $row["title"]["url"] = Yii::app()->createUrl('payments/invoice', array('id' => $record->id));
            $row["summa"] = number_format($record->summa, 2, ",","&nbsp;");
            $row["date"] = date("d.m.y", strtotime($record->payment_date));
            $row["url"] = Yii::app()->createUrl('payments/invoice', array('id' => $record->id, 'nolayout' => true));

            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public function getOrderInAgreement(){
        return explode("/", $this->number)[1];
    }
}
