<?php

/**
 * This is the model class for table "aboutus_slider".
 *
 * The followings are the available columns in table 'aboutus_slider':
 * @property integer $image_order
 * @property string $pictureUrl
 * @property integer $text
 * @property integer $order
 */
class AboutusSlider extends Slider
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aboutus_slider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pictureUrl', 'required'),
			array('image_order , text , order', 'numerical', 'integerOnly'=>true),
			array('pictureUrl', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('image_order, pictureUrl, order, text', 'safe', 'on'=>'search'),
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
			'image_order' => 'Порядок зображення',
			'pictureUrl' => 'Фото *',
            'order' => 'Порядок зображення',
            'text' => 'Код тексту *'
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

		$criteria->compare('image_order',$this->image_order);
		$criteria->compare('pictureUrl',$this->pictureUrl,true);
        $criteria->compare('text',$this->text,true);
        $criteria->compare('order',$this->order,true);


        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AboutusSlider the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
