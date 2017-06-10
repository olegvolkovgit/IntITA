<?php

/**
 * This is the model class for table "acc_contracting_party_corporate_entity".
 *
 * The followings are the available columns in table 'acc_contracting_party_corporate_entity':
 * @property integer $id
 * @property integer $corporate_entity_id
 * @property integer $checking_account_id
 *
 * The followings are the available model relations:
 * @property CheckingAccounts $checkingAccount
 * @property ContractingParty $id0
 * @property CorporateEntity $corporateEntity
 */
class ContractingPartyCorporateEntity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_contracting_party_corporate_entity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, corporate_entity_id, checking_account_id', 'required'),
			array('id, corporate_entity_id, checking_account_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, corporate_entity_id, checking_account_id', 'safe', 'on'=>'search'),
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
			'checkingAccount' => array(self::BELONGS_TO, 'CheckingAccounts', 'checking_account_id'),
			'id0' => array(self::BELONGS_TO, 'ContractingParty', 'id'),
			'corporateEntity' => array(self::BELONGS_TO, 'CorporateEntity', 'corporate_entity_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'corporate_entity_id' => 'Corporate Entity',
			'checking_account_id' => 'Checking Account',
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
		$criteria->compare('corporate_entity_id',$this->corporate_entity_id);
		$criteria->compare('checking_account_id',$this->checking_account_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContractingPartyCorporateEntity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
