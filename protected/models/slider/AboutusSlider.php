<?php

/**
 * This is the model class for table "aboutus_slider".
 *
 * The followings are the available columns in table 'aboutus_slider':
 * @property integer $image_order
 * @property string $pictureUrl
 * @property string $text_ua
 * @property string $text_ru
 * @property string $text_en
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
            array('pictureUrl', 'file', 'types' => 'jpg,jpeg, gif, png','allowEmpty' => true, 'message' => 'Виберіть файл','except'=>'swapImage,setOrder'),
			array('pictureUrl', 'file', 'types' => 'jpg,jpeg, gif, png','allowEmpty' => false, 'message' => 'Виберіть файл','on'=>'insert'),
            array('text_ua, text_ru, text_en', 'required','message' => 'Поле має бути заповнено'),
            array('image_order, order', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order, pictureUrl, image_order, text_ua, text_ru, text_en', 'safe', 'on'=>'search'),
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
			'pictureUrl' => 'Зображення',
            'order' => 'Порядок зображення',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('image_order',$this->image_order);
		$criteria->compare('pictureUrl',$this->pictureUrl,true);
        $criteria->compare('text_ua',$this->text_ua,true);
		$criteria->compare('text_ru',$this->text_ru,true);
		$criteria->compare('text_en',$this->text_en,true);
        $criteria->compare('order',$this->order,true);


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
	 * @return AboutusSlider the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getItemsList(){
        $graduates = AboutusSlider::model()->findAll();
        $return = array('data' => array());

        foreach ($graduates as $record) {
            $row = array();
            $row["photo"]["image"] = StaticFilesHelper::createPath("image", "aboutus", $record->pictureUrl);
            $row["order"] = $record->order;
			$row["id"] = $record->image_order;
			$row["photo"]["text"] = $record->text_ua;
            $row["linkUp"] = "'".Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/up", array("order"=>$record->order))."'";
            $row["linkDown"] = "'".Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/down", array("order"=>$record->order))."'";
			$row["textUp"] = "'".Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/textUp", array("order"=>$record->order))."'";
			$row["textDown"] = "'".Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/textDown", array("order"=>$record->order))."'";
            $row["photo"]["link"] = "'".Yii::app()->createUrl("/_teacher/_admin/aboutusSlider/view", array("id"=>$record->image_order))."'";
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
