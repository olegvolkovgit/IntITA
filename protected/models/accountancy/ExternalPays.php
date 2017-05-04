<?php

/**
 * This is the model class for table "acc_external_pays".
 *
 * The followings are the available columns in table 'acc_external_pays':
 * @property string $id
 * @property string $createDate
 * @property integer $createUser
 * @property string $sourceId
 * @property integer $userId
 * @property string $documentDate
 * @property float $amount
 * @property string $documentPurpose
 * @property string $documentNumber
 * @property string $comment
 * @property integer $companyId
 * @property string $payerName
 * @property string $payerId
 *
 * The followings are the available model relations:
 * @property ExternalSources $source
 * @property CorporateEntity $company
 * @property InternalPays[] $internalPays
 */
class ExternalPays extends CActiveRecord {

    use withBelongsToOrganization;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_external_pays';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createUser, sourceId, userId, documentDate, amount, documentNumber, documentPurpose, companyId', 'required', 'message'=>'Поле \'{attribute}\' не може бути пустим'),
			array('createUser, userId, companyId', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical', 'min'=>0, 'message'=>'Поле \'{attribute}\' має містити дані в числовому форматі'),
			array('documentDate', 'date', 'format' => 'yyyy-M-d', 'message' => 'Поле \'{attribute}\' має містити дані в форматі рррр-мм-дд'),
			array('sourceId, amount', 'length', 'max'=>10),
			array('documentPurpose', 'length', 'max'=>512),
			array('documentNumber', 'length', 'max'=>100),
			array('comment, payerName, payerId', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, createDate, createUser, sourceId, userId, documentDate, amount, documentPurpose, documentNumber, comment, companyId, payerName, payerId', 'safe', 'on'=>'search'),
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
            'source' => array(self::BELONGS_TO, 'ExternalSources', 'sourceId'),
            'company' => [self::BELONGS_TO, 'CorporateEntity', 'companyId'],
            'internalPays' => [self::HAS_MANY, 'InternalPays', 'externalPaymentId'],
            'organization' => [self::HAS_ONE, 'Organization', ['id_organization' => 'id'], 'through' => 'company']
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'Pay code',
            'createDate' => 'Дата створення ',
            'createUser' => 'Хто створив',
            'sourceId' => 'Джерело коштів',
            'userId' => 'Хто платить',
            'documentDate' => 'Дата документа',
            'amount' => 'Сумма',
            'documentPurpose' => 'Призначення платежу',
			'companyId' => 'Компанія',
			'payerName' => 'Назва платника',
			'payerId' => 'Ідентифікаційний код'
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('createDate',$this->createDate,true);
		$criteria->compare('createUser',$this->createUser);
		$criteria->compare('sourceId',$this->sourceId,true);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('documentDate',$this->documentDate,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('documentPurpose',$this->documentPurpose,true);
		$criteria->compare('documentNumber',$this->documentNumber,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('companyId',$this->comment);
		$criteria->compare('payerName',$this->payerName,true);
		$criteria->compare('payerId',$this->payerId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExternalPays the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getUnallocatedAmount() {
        $this->getRelated('internalPays');
        return array_reduce($this->internalPays, function($prev, $curr) {return $prev -= $curr->summa;}, $this->amount);
    }

	public function getRemainderSum() {
		$internalPays=InternalPays::model()->findAllByAttributes(array('externalPaymentId'=>$this->id));
		$sum=0;
		foreach ($internalPays as $pay){
			$sum=$sum+$pay->summa;
		}
		return round(floatval($this->amount)-$sum,2);
	}

    /**
     * The method should return CDBCriteria to select entity belong to organisation
     * @param Organization $organization
     * @return CDbCriteria
     */
    public function getOrganizationCriteria(Organization $organization) {
        $criteria = new CDbCriteria([
            'condition' => 'organization.id = :organizationId',
            'params' => ['organizationId' => $organization->id],
            'with' => 'organization'
        ]);
        return $criteria;
    }
}
