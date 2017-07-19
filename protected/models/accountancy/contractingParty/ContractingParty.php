<?php

/**
 * This is the model class for table "acc_contracting_party".
 *
 * The followings are the available columns in table 'acc_contracting_party':
 * @property integer $id
 * @property integer $type_id
 *
 * The followings are the available model relations:
 * @property ContractingPartyType $type
 * @property ContractingPartyCorporateEntity $contractingPartyCorporateEntity
 * @property ContractingPartyCorporateEntityRepresentatives[] $contractingPartyCorporateEntityRepresentatives
 * @property ContractingPartyPrivatePerson $contractingPartyPrivatePerson
 * @property UserAgreements[] $accUserAgreements
 */
class ContractingParty extends CActiveRecord {

    const ROLE_STUDENT=1;
    const ROLE_COMPANY=2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_contracting_party';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id', 'required'),
			array('type_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type_id', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'ContractingPartyType', 'type_id'),
			'contractingPartyCorporateEntity' => array(self::HAS_ONE, 'ContractingPartyCorporateEntity', 'id'),
			'contractingPartyCorporateEntityRepresentatives' => array(self::HAS_MANY, 'ContractingPartyCorporateEntityRepresentatives', 'contracting_party_id'),
			'contractingPartyPrivatePerson' => array(self::HAS_ONE, 'ContractingPartyPrivatePerson', 'id'),
			'accUserAgreements' => array(self::MANY_MANY, 'UserAgreements', 'acc_user_agreement_contracting_party(contracting_party_id, user_agreement_id)'),
            'corporateEntityRepresentatives' => [self::HAS_MANY, 'CorporateEntityRepresentatives',['corporate_representative_id'=>'corporate_representative'], 'through' => 'contractingPartyCorporateEntityRepresentatives'],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_id' => 'Type',
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
		$criteria->compare('type_id',$this->type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContractingParty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param UserAgreements $agreement
     * @param integer $roleId
     * @throws Exception
     */
	public function bindToAgreement(UserAgreements $agreement, $roleId) {
	    $binding = new UserAgreementContractingParty();
	    $binding->user_agreement_id = $agreement->id;
	    $binding->contracting_party_id = $this->id;
	    $binding->role_id = $roleId;
	    if (!$binding->save()) {
	        throw new Exception("Unable to create binding with contracting party");
        };
    }
}
