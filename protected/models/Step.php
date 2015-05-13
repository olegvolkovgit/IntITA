<?php

/**
 * This is the model class for table "step".
 *
 * The followings are the available columns in table 'step':
 * @property integer $step_id
 * @property string $stepName
 * @property integer $stepNumber
 * @property string $stepTitle
 * @property string $stepImagePath
 * @property string $stepImage
 * @property string $stepText
 *
 * The followings are the available model relations:
 * @property Mainpage[] $mainpages
 * @property Mainpage[] $mainpages1
 * @property Mainpage[] $mainpages2
 * @property Mainpage[] $mainpages3
 * @property Mainpage[] $mainpages4
 */
class Step extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'step';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stepNumber, stepTitle, stepImage, stepText', 'required'),
			array('stepNumber', 'numerical', 'integerOnly'=>true),
			array('stepName', 'length', 'max'=>30),
			array('stepTitle, stepImage', 'length', 'max'=>50),
			array('stepImagePath', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('step_id, stepName, stepNumber, stepTitle, stepImagePath, stepImage, stepText', 'safe', 'on'=>'search'),
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
			'mainpages' => array(self::HAS_MANY, 'Mainpage', 'step1'),
			'mainpages1' => array(self::HAS_MANY, 'Mainpage', 'step2'),
			'mainpages2' => array(self::HAS_MANY, 'Mainpage', 'step3'),
			'mainpages3' => array(self::HAS_MANY, 'Mainpage', 'step4'),
			'mainpages4' => array(self::HAS_MANY, 'Mainpage', 'step5'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'step_id' => 'Step',
			'stepName' => 'Step Name',
			'stepNumber' => 'Step Number',
			'stepTitle' => 'Step Title',
			'stepImagePath' => 'Step Image Path',
			'stepImage' => 'Step Image',
			'stepText' => 'Step Text',
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

		$criteria->compare('step_id',$this->step_id);
		$criteria->compare('stepName',$this->stepName,true);
		$criteria->compare('stepNumber',$this->stepNumber);
		$criteria->compare('stepTitle',$this->stepTitle,true);
		$criteria->compare('stepImagePath',$this->stepImagePath,true);
		$criteria->compare('stepImage',$this->stepImage,true);
		$criteria->compare('stepText',$this->stepText,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Step the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
