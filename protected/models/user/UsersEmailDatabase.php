<?php

/**
 * This is the model class for table "users_email".
 *
 * The followings are the available columns in table 'users_email':
 * @property string $email
 * @property integer $category
 *
 * @property EmailsCategory $emailCategory
 */
class UsersEmailDatabase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users_email';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, category', 'required'),
			array('email, category', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('email, category', 'safe', 'on'=>'search'),
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
			'emailCategory' => array(self::BELONGS_TO, 'EmailsCategory', array('category'=>'id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'email' => 'Email',
			'category' => 'Category',
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
		
		$criteria->compare('email',$this->email,true);
		$criteria->compare('category',$this->category,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsersEmailDatabase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function primaryKey(){
		return array('email','category');
	}
}
