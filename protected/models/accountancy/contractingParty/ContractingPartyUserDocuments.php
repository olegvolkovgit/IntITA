<?php

/**
 * This is the model class for table "acc_contracting_party_user_documents".
 *
 * The followings are the available columns in table 'acc_contracting_party_user_documents':
 * @property integer $id
 * @property integer $id_contracting_party
 * @property integer $id_documents
 * @property string $create_date
 * @property integer $checked_by
 *
 * The followings are the available model relations:
 * @property ContractingPartyPrivatePerson $idContractingParty
 */
class ContractingPartyUserDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_contracting_party_user_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_contracting_party, id_documents', 'required'),
			array('id_contracting_party, id_documents', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_contracting_party, id_documents, create_date, checked_by', 'safe', 'on'=>'search'),
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
			'idContractingParty' => array(self::BELONGS_TO, 'ContractingPartyPrivatePerson', 'id_contracting_party'),
            'idUser' => array(self::BELONGS_TO, 'StudentReg', 'checked_by'),
            'documents' => array(self::BELONGS_TO, 'UserDocuments', 'id_documents'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_contracting_party' => 'Id Contracting Party',
			'id_documents' => 'Id Documents',
            'create_date' => 'Create Date',
            'checked_by' => 'Checked By',
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
		$criteria->compare('id_contracting_party',$this->id_contracting_party);
		$criteria->compare('id_documents',$this->id_documents);
        $criteria->compare('create_date',$this->create_date);
        $criteria->compare('checked_by',$this->checked_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContractingPartyUserDocuments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
