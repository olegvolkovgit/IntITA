<?php

/**
 * This is the model class for table "module_rating".
 *
 * The followings are the available columns in table 'module_rating':
 * @property integer $id
 * @property integer $id_module
 * @property integer $id_module_revision
 * @property integer $id_user
 * @property integer $understand_rating
 * @property integer $interesting_rating
 * @property integer $accessibility_rating
 * @property string $comment
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property StudentReg $idUser
 */
class ModuleRating extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_rating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_module, id_module_revision, id_user', 'required'),
			array('id_module, id_module_revision, id_user, understand_rating, interesting_rating, accessibility_rating', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_module, id_module_revision, id_user, understand_rating, interesting_rating, accessibility_rating, comment, create_date', 'safe', 'on'=>'search'),
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
			'idUser' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
            'module' => array(self::BELONGS_TO, 'Module', 'id_module'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_module' => 'Id Module',
			'id_module_revision' => 'Id Module Revision',
			'id_user' => 'Id User',
			'understand_rating' => 'Understand Rating',
			'interesting_rating' => 'Interesting Rating',
			'accessibility_rating' => 'Accessibility Rating',
			'comment' => 'Comment',
			'create_date' => 'Create Date',
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
		$criteria->compare('id_module',$this->id_module);
		$criteria->compare('id_module_revision',$this->id_module_revision);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('understand_rating',$this->understand_rating);
		$criteria->compare('interesting_rating',$this->interesting_rating);
		$criteria->compare('accessibility_rating',$this->accessibility_rating);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModuleRating the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
