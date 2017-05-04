<?php

/**
 * This is the model class for table "acc_internal_pays".
 *
 * The followings are the available columns in table 'acc_internal_pays':
 * @property integer $id
 * @property string $create_date
 * @property integer $create_user
 * @property integer $invoice_id
 * @property string $summa
 * @property integer $externalPaymentId
 *
 * The followings are the available model relations:
 * @property StudentReg $createUser
 */
class InternalPays extends CActiveRecord {

    use withBelongsToOrganization;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_internal_pays';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_user, invoice_id, summa, externalPaymentId', 'required'),
			array('create_user, invoice_id, externalPaymentId', 'numerical', 'integerOnly'=>true),
			array('summa', 'length', 'max'=>10),
			// The following rule is used by search().
			array('id, create_date, create_user, invoice_id, summa, externalPaymentId', 'safe', 'on'=>'search'),
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
            'createUser' => array(self::BELONGS_TO, 'StudentReg', 'create_user'),
            'externalPayment' => [self::BELONGS_TO, 'ExternalPays', 'externalPaymentId'],
            'invoice' => [self::BELONGS_TO, 'Invoice', 'invoice_id'],
            'corporateEntity' => [self::BELONGS_TO, 'CorporateEntity', ['companyId' => 'id'], 'through' => 'externalPayment'],
            'organization' => [self::BELONGS_TO, 'Organization', ['id_organization' => 'id'], 'through' => 'corporateEntity']
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'id операції',
            'create_date' => 'Дата створення',
            'create_user' => 'Хто створив',
            'agreement_id' => 'Номер договору',
            'summa' => 'Сумма до сплати',
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
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('summa',$this->summa,true);
		$criteria->compare('externalPaymentId',$this->summa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InternalPays the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function create($params){
        $model = new InternalPays();
        $model->setAttributes($params);
        if ($model->validate()) {
            $model->save(false);
            return $model;
        } else {
            return $model->getErrors();
        }
    }

    /**
     * The method should return CDBCriteria to select entity belong to organisation
     * @param Organization $organization
     * @return CDbCriteria
     */
    public function getOrganizationCriteria(Organization $organization) {
        return new CDbCriteria([
            'condition' => 'organization.id = :organizationId',
            'params' => ['organizationId' => $organization->id],
            'with' => 'organization'
        ]);

    }
}
