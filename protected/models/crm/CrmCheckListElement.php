<?php

/**
 * This is the model class for table "crm_check_list_element".
 *
 * The followings are the available columns in table 'crm_check_list_element':
 * @property integer $id
 * @property integer $id_list
 * @property string $name
 * @property integer $done
 *
 * The followings are the available model relations:
 * @property CrmCheckList $idList
 */
class CrmCheckListElement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_check_list_element';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_list, name', 'required'),
			array('id_list, done', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_list, name, done', 'safe', 'on'=>'search'),
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
			'idList' => array(self::BELONGS_TO, 'CrmCheckList', 'id_list'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_list' => 'Id List',
			'name' => 'Name',
			'done' => 'Done',
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
		$criteria->compare('id_list',$this->id_list);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('done',$this->done);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrmCheckListElement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
