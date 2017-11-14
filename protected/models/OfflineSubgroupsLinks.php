<?php

/**
 * This is the model class for table "offline_subgroups_links".
 *
 * The followings are the available columns in table 'offline_subgroups_links':
 * @property integer $id
 * @property integer $id_subgroup
 * @property string $description
 * @property string $link
 * @property integer $updated_by
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property OfflineSubgroups $idSubgroup
 * @property StudentReg $updatedBy
 */
class OfflineSubgroupsLinks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'offline_subgroups_links';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_subgroup, description, link', 'required'),
			array('id_subgroup, updated_by', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			array('link', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_subgroup, description, link, updated_by, updated_at', 'safe', 'on'=>'search'),
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
			'idSubgroup' => array(self::BELONGS_TO, 'OfflineSubgroups', 'id_subgroup'),
			'updatedBy' => array(self::BELONGS_TO, 'StudentReg', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_subgroup' => 'Id Subgroup',
			'description' => 'Description',
			'link' => 'Link',
			'updated_by' => 'Updated By',
			'updated_at' => 'Updated At',
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
		$criteria->compare('id_subgroup',$this->id_subgroup);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OfflineSubgroupsLinks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
