<?php

/**
 * This is the model class for table "carousel".
 *
 * The followings are the available columns in table 'carousel':
 * @property integer $order
 * @property string $pictureURL
 * @property string $slider_text
 */
class Carousel extends Slider
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'carousel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('pictureURL', 'file', 'types' => 'jpg, gif, png','message' => 'Виберіть файл','except'=>'swapImage'),
			array('pictureURL, slider_text', 'required','message' => 'Поле має бути заповнено'),
			array('order', 'numerical', 'integerOnly'=>true),
			array('pictureURL', 'length', 'max'=>50),
            array('slider_text', 'length', 'max'=>6),
			// The following rule is used by search().
			array('order, pictureURL, slider_text', 'safe', 'on'=>'search'),
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
			'order' => 'Порядок відображення',
			'pictureURL' => 'Фото',
            'slider_text' => 'Код тексту для слайдера',
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

		$criteria->compare('order',$this->order);
		$criteria->compare('pictureURL',$this->pictureURL,true);
        $criteria->compare('slider_text',$this->slider_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'`order` ASC',
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Carousel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



}
