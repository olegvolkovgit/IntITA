<?php

/**
 * This is the model class for table "acc_internal_pays".
 *
 * The followings are the available columns in table 'acc_internal_pays':
 * @property integer $id
 * @property string $create_date
 * @property integer $create_user
 * @property integer $invoice_id
 * @property string $description
 * @property string $summa
 *
 * The followings are the available model relations:
 * @property StudentReg $createUser
 */
class InternalPays extends CActiveRecord
{
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
			array('create_user, invoice_id, summa', 'required'),
			array('create_user, invoice_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>512),
			array('summa', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_date, create_user, invoice_id, description, summa', 'safe', 'on'=>'search'),
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
            'createUser' => array(self::BELONGS_TO, 'User', 'create_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_date' => 'Create Date',
			'create_user' => 'Create User',
			'invoice_id' => 'Invoice',
			'description' => 'Description',
			'summa' => 'Summa',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('summa',$this->summa,true);

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

    public static function addNewInternalPay($invoice, $user){
        $model = new InternalPays();

        $model->invoice_id = $invoice;
        $model->create_user = $user;
        $model->summa = Invoice::getSumma($invoice);
        $model->description = OperationType::getDescription(2).". ".
            "Invoices list, invoice pay date. "."Оплачено ";//.date("d.m.y", strtotime($invoice->pay_date));

        return $model->save();

    }
}
