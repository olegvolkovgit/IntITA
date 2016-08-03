<?php

/**
 * This is the model class for table "acc_payment_schema".
 *
 * The followings are the available columns in table 'acc_payment_schema':
 * @property string $id
 * @property string $discount
 * @property integer $pay_count
 * @property string $loan
 * @property string $name
 * @property integer $monthpay
 */
class PaymentScheme extends CActiveRecord
{
	const ADVANCE = 1;
    const BASE_TWO_PAYS = 2;
    const BASE_FOUR_PAYS = 3;
    const MONTHLY = 4;
    const CREDIT_TWO_YEARS = 5;
    const CREDIT_THREE_YEARS = 6;
    const CREDIT_FOUR_YEARS = 7;
    const CREDIT_FIVE_YEARS = 8;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_payment_schema';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('pay_count, monthpay', 'numerical', 'integerOnly'=>true),
			array('discount, loan', 'length', 'max'=>10),
			array('name', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, discount, pay_count, loan, name, monthpay', 'safe', 'on'=>'search'),
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
            'id' => 'ID',
            'discount' => 'відсоток знижки',
            'pay_count' => 'кількість проплат',
            'loan' => 'відсоток',
            'name' => 'опис',
            'monthpay' => 'кількість платежів по-місячно',
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
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('pay_count',$this->pay_count);
		$criteria->compare('loan',$this->loan,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('monthpay',$this->monthpay);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentScheme the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getSchema($id, $educFormId){
        $schema = null;
        $educForm = EducationForm::model()->findByPk($educFormId);
        $model = PaymentScheme::model()->findByPk($id);
        if ($model->loan > 0){
            $schema = new LoanPaymentSchema($model->loan, $model->pay_count, $educForm);
        }else{
            if ($model->monthpay > 0){
                $schema = new BasePaymentSchema($model->pay_count, $educForm);
            } else {
                $schema = new AdvancePaymentSchema($model->discount, $model->pay_count, $educForm);
            }
        }

        return $schema;
    }

    public static function getName($id){
        return PaymentScheme::model()->findByPk($id)->name;
    }
}
