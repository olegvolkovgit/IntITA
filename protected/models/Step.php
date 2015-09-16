<?php

/**
 * This is the model class for table "step".
 *
 * The followings are the available columns in table 'step':
 * @property integer $step_id
 * @property integer $stepNumber
 * @property string $stepTitle
 * @property string $stepImage
 * @property string $stepText
 *
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
			array('stepTitle, stepImage', 'length', 'max'=>50),
			// The following rule is used by search().
			array('step_id, stepNumber, stepTitle, stepImage, stepText', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'step_id' => 'Step',
			'stepNumber' => 'Step Number',
			'stepTitle' => 'Step Title',
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
		$criteria=new CDbCriteria;

		$criteria->compare('step_id',$this->step_id);
		$criteria->compare('stepNumber',$this->stepNumber);
		$criteria->compare('stepTitle',$this->stepTitle,true);
		$criteria->compare('stepImage',$this->stepImage,true);
		$criteria->compare('stepText',$this->stepText,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array('attributes'=>array(
                'defaultOrder'=>array(
                    'stepNumber'=>CSort::SORT_ASC,
                ),
            )),
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
