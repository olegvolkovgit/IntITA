<?php

/**
 * This is the model class for table "acc_contracting_party_corporate_entity_representatives".
 *
 * The followings are the available columns in table 'acc_contracting_party_corporate_entity_representatives':
 * @property integer $id
 * @property integer $contracting_party_id
 * @property integer $corporate_representative_id
 *
 * The followings are the available model relations:
 * @property ContractingParty $contractingParty
 * @property CorporateRepresentative $corporateRepresentative
 */
class ContractingPartyCorporateEntityRepresentatives extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_contracting_party_corporate_entity_representatives';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contracting_party_id, corporate_representative_id', 'required'),
			array('contracting_party_id, corporate_representative_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contracting_party_id, corporate_representative_id', 'safe', 'on'=>'search'),
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
			'contractingParty' => array(self::BELONGS_TO, 'ContractingParty', 'contracting_party_id'),
			'corporateRepresentative' => array(self::BELONGS_TO, 'CorporateRepresentative', 'corporate_representative_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contracting_party_id' => 'Contracting Party',
			'corporate_representative_id' => 'Corporate Representative',
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
		$criteria->compare('contracting_party_id',$this->contracting_party_id);
		$criteria->compare('corporate_representative_id',$this->corporate_representative_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContractingPartyCorporateEntityRepresentatives the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
