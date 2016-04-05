<?php

/**
 * This is the model class for table "carousel".
 *
 * The followings are the available columns in table 'carousel':
 * @property integer $order
 * @property string $pictureURL
 * @property string $text_ua
 * @property string $text_ru
 * @property string $text_en
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
            array('pictureURL', 'file', 'types' => 'jpg, gif, png, jpeg,','allowEmpty' => true,'message' => 'Виберіть файл','except' => 'swapImage,setOrder'),
			array('pictureURL', 'file', 'types' => 'jpg,jpeg, gif, png','allowEmpty' => false, 'message' => 'Виберіть файл','on'=>'insert'),
			array('text_ua, text_ru, text_en', 'required','message' => 'Поле має бути заповнено','except' => 'setOrder'),
			array('order', 'numerical', 'integerOnly'=>true),
            array('order','numerical', 'on'=>'setOrder'),
			array('pictureURL', 'length', 'max'=>50),
			// The following rule is used by search().
			array('order, pictureURL, text_ua, text_ru, text_en', 'safe', 'on'=>'search'),
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
			'text_ua' => 'Текст слайду ua',
			'text_ru' => 'Текст слайду ru',
			'text_en' => 'Текст слайду en'
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
		$criteria->compare('text_ua',$this->text_ua,true);
		$criteria->compare('text_ru',$this->text_ru,true);
		$criteria->compare('text_en',$this->text_en,true);

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

	public static function getItemsList(){
		$sliders = Carousel::model()->findAll();
		$return = array('data' => array());

		foreach ($sliders as $record) {
			$row = array();
			$row["photo"]["image"] = StaticFilesHelper::createPath("image", "mainpage", $record->pictureURL);
			$row["order"] = $record->order;
			$row["photo"]["text"] = CHtml::encode($record->text_ua);
			$row["linkUp"] = "'".Yii::app()->createUrl("/_teacher/_admin/carousel/up", array("order"=>$record->order))."'";
			$row["linkDown"] = "'".Yii::app()->createUrl("/_teacher/_admin/carousel/down", array("order"=>$record->order))."'";
			$row["textUp"] = "'".Yii::app()->createUrl("/_teacher/_admin/carousel/textUp", array("order"=>$record->order))."'";
			$row["textDown"] = "'".Yii::app()->createUrl("/_teacher/_admin/carousel/textDown", array("order"=>$record->order))."'";
			$row["photo"]["link"] = "'".Yii::app()->createUrl("/_teacher/_admin/carousel/view", array("id"=>$record->id))."'";
			array_push($return['data'], $row);
		}

		return json_encode($return);
	}
	public function getText()
	{
		$lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
		$text = "text_" . $lang;

		return $this->$text;
	}

}
