<?php

/**
 * This is the model class for table "mainpage".
 *
 * The followings are the available columns in table 'mainpage':
 * @property integer $id
 * @property string $language
 * @property string $message
 * @property string $category
 * @property string $title
 * @property string $sliderHeader
 * @property string $sliderText
 * @property string $sliderTextureURL
 * @property string $sliderLineURL
 * @property string $sliderButtonText
 * @property string $header1
 * @property string $subLineImage
 * @property string $subheader1
 * @property string $arrayBlocks
 * @property string $header2
 * @property string $subheader2
 * @property string $arraySteps
 * @property string $stepSize
 * @property string $linkName
 * @property string $hexagon
 * @property string $formHeader1
 * @property string $formHeader2
 * @property string $regText
 * @property string $buttonStart
 * @property string $socialText
 * @property string $imageNetwork
 * @property string $formFon
 *
 * The followings are the available model relations:
 * @property Mainpagetranslated $id0
 * @property Mainpagetranslated[] $mainpagetranslateds
 */
class Mainpage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public function tableName()
	{
		return 'mainpage';
	}

	public function setValueById($id)
	{

		$this->sliderTextureURL=Yii::app()->request->baseUrl.$this->findByPk($id)->sliderTextureURL;
		$this->stepSize=$this->findByPk($id)->stepSize;
		$this->subLineImage=Yii::app()->request->baseUrl.$this->findByPk($id)->subLineImage;
		$this->hexagon=Yii::app()->request->baseUrl.$this->findByPk($id)->hexagon;
		$this->sliderLineURL=Yii::app()->request->baseUrl.$this->findByPk($id)->sliderLineURL;
		$this->imageNetwork = Yii::app()->request->baseUrl.$this->findByPk($id)->imageNetwork;
		$this->formFon = Yii::app()->request->baseUrl.$this->findByPk($id)->formFon;
		return $this;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, language, category, title, sliderHeader, sliderText, sliderTextureURL, sliderLineURL, sliderButtonText, header1, subLineImage, subheader1, arrayBlocks, header2, subheader2, arraySteps, stepSize, linkName, hexagon, formHeader1, formHeader2, regText, buttonStart, socialText, imageNetwork, formFon', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>2),
			array('category', 'length', 'max'=>32),
			array('title, message, subheader1, subheader2', 'length', 'max'=>100),
			array('sliderHeader, header1, header2, formHeader1, formHeader2, regText, buttonStart, socialText', 'length', 'max'=>50),
			array('sliderText, sliderTextureURL, sliderLineURL, subLineImage, hexagon, imageNetwork, formFon', 'length', 'max'=>255),
			array('sliderButtonText, linkName', 'length', 'max'=>20),
			array('arrayBlocks, arraySteps, stepSize', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, language, category, title, sliderHeader, sliderText, sliderTextureURL, sliderLineURL, sliderButtonText, header1, subLineImage, subheader1, arrayBlocks, header2, subheader2, arraySteps, stepSize, linkName, hexagon, formHeader1, formHeader2, regText, buttonStart, socialText, imageNetwork, formFon', 'safe', 'on'=>'search'),
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
			'id0' => array(self::BELONGS_TO, 'Mainpagetranslated', 'id'),
			'mainpagetranslateds' => array(self::HAS_MANY, 'Mainpagetranslated', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'ID',
            'language' => 'Language',
            'message' => 'Message',
            'category' => 'Category',
            'title' => Yii::t('mainpage', '0001'),
            'sliderHeader' => Yii::t('mainpage', '0005'),
            'sliderText' => Yii::t('mainpage', '0027'),
            'sliderTextureURL' => 'Slider texture',
            'sliderLineURL' => 'Slider line',
            'sliderButtonText' => Yii::t('mainpage', '0008'),
            'header1' => Yii::t('mainpage', '0002'),
            'subLineImage' => 'Subline image',
            'subheader1' => Yii::t('mainpage', '0006'),
            'arrayBlocks' => 'Blocks',
            'header2' => Yii::t('mainpage', '0003'),
            'subheader2' => Yii::t('mainpage', '0007'),
            'arraySteps' => 'Steps',
            'stepSize' => 'Step size',
            'linkName' => Yii::t('mainpage', '0004'),
            'hexagon' => 'Hexagon',
            'formHeader1' => Yii::t('mainpage', '0009'),
            'formHeader2' => Yii::t('mainpage', '0010'),
            'regText' => Yii::t('mainpage', '0011'),
            'buttonStart' => Yii::t('mainpage', '0013'),
            'socialText' => Yii::t('mainpage', '0012'),
            'imageNetwork' => 'Image Network',
            'formFon' => 'Form Fon',
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
		$criteria->compare('language',$this->language,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('title',Yii::t('mainpage', '0001'),true);
		$criteria->compare('sliderHeader',Yii::t('mainpage', '0005'),true);
		$criteria->compare('sliderText',$this->sliderText,true);
		$criteria->compare('sliderTextureURL',$this->sliderTextureURL,true);
		$criteria->compare('sliderLineURL',$this->sliderLineURL,true);
		$criteria->compare('sliderButtonText',Yii::t('mainpage', '0008'),true);
		$criteria->compare('header1',Yii::t('mainpage', '0002'),true);
		$criteria->compare('subLineImage',$this->subLineImage,true);
		$criteria->compare('subheader1', Yii::t('mainpage', '0006'),true);
		$criteria->compare('arrayBlocks',$this->arrayBlocks,true);
		$criteria->compare('header2',Yii::t('mainpage', '0003'),true);
		$criteria->compare('subheader2',Yii::t('mainpage', '0007'),true);
		$criteria->compare('arraySteps',$this->arraySteps,true);
		$criteria->compare('stepSize',$this->stepSize,true);
		$criteria->compare('linkName',Yii::t('mainpage', '0004'),true);
		$criteria->compare('hexagon',$this->hexagon,true);
		$criteria->compare('formHeader1',Yii::t('mainpage', '0009'),true);
		$criteria->compare('formHeader2',Yii::t('mainpage', '0010'),true);
		$criteria->compare('regText',$this->regText,true);
		$criteria->compare('buttonStart',Yii::t('mainpage', '0013'),true);
		$criteria->compare('socialText',Yii::t('mainpage', '0012'),true);
		$criteria->compare('imageNetwork',$this->imageNetwork,true);
		$criteria->compare('formFon',$this->formFon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mainpage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTitle(){
		return Yii::t('mainpage', '0001');
	}

  	public function getSliderHeader(){
		return Yii::t('slider', '0005');
	}

	public function getHeader1(){
		return Yii::t('mainpage','0002');
	}

	public function getSubheader1(){
		return Yii::t('mainpage', '0006');
	}

    public function getSliderButtonText(){
        return Yii::t('slider', '0008');
    }

    public function getHeader2()
    {
        return Yii::t('mainpage', '0003');
    }

    public function getSubheader2(){
        return Yii::t('mainpage', '0007');
    }

    public function getLinkName(){
        return Yii::t('mainpage', '0004');
    }

    public function getFormHeader1(){
        return Yii::t('regform', '0009');
    }

    public function getFormHeader2(){
        return Yii::t('regform', '0010');
    }

    public function getRegText(){
        return Yii::t('regform', '0011');
    }

    public function getButtonStart(){
        return Yii::t('regform', '0013');
    }

    public function getSocialText(){
        return Yii::t('regform', '0012');
    }



}
