<?php

/**
 * This is the model class for table "acc_written_agreement_template".
 *
 * The followings are the available columns in table 'acc_written_agreement_template':
 * @property integer $id
 * @property string $template
 * @property string $name
 * @property integer $id_organization
 * @property integer $create_by
 * @property string $updateAt
 *
 * The followings are the available model relations:
 * @property Organization $idOrganization
 * @property StudentReg $createBy
 */
class WrittenAgreementTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_written_agreement_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_organization, create_by, name', 'required'),
			array('id_organization, create_by', 'numerical', 'integerOnly'=>true),
			array('template', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, template, id_organization, create_by, updateAt, name', 'safe', 'on'=>'search'),
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
			'idOrganization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
			'createBy' => array(self::BELONGS_TO, 'StudentReg', 'create_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'template' => 'Template',
			'id_organization' => 'Id Organization',
			'create_by' => 'Create By',
			'updateAt' => 'Update At',
            'name' => 'Name',
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
		$criteria->compare('template',$this->template,true);
		$criteria->compare('id_organization',$this->id_organization);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('updateAt',$this->updateAt,true);
        $criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WrittenAgreementTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
