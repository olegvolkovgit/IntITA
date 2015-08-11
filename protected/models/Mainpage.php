<?php

/**
 * This is the model class for table "mainpage".
 *
 * The followings are the available columns in table 'mainpage':
 * @property integer $id
 * @property string $sliderTextureURL
 * @property string $sliderLineURL
 * @property string $subLineImage
 * @property string $arrayBlocks
 * @property string $arraySteps
 * @property string $stepSize
 * @property string $hexagon
 * @property string $socialText
 * @property string $imageNetwork
 * @property string $formFon
 */
class Mainpage extends CActiveRecord
{
    public $stepSize;

	/**
	 * @return string the associated database table name
	 */

	public function tableName()
	{
		return 'mainpage';
	}

	public function setValueById($id)
	{
        $this->stepSize = "958px";
		$this->sliderTextureURL=$this->findByPk($id)->sliderTextureURL;
		$this->subLineImage = $this->findByPk($id)->subLineImage;
		$this->hexagon = $this->findByPk($id)->hexagon;
		$this->sliderLineURL=$this->findByPk($id)->sliderLineURL;
		$this->formFon = $this->findByPk($id)->formFon;
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
			array('sliderTextureURL, sliderLineURL, subLineImage, hexagon, imageNetwork, formFon', 'length', 'max'=>255),
			array('arrayBlocks, arraySteps, stepSize', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sliderTextureURL, sliderLineURL, arrayBlocks, arraySteps, stepSize, hexagon, imageNetwork, formFon', 'safe', 'on'=>'search'),
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
            'id' => 'ID',
            'sliderTextureURL' => 'Slider texture',
            'sliderLineURL' => 'Slider line',
            'subLineImage' => 'Subline image',
            'arrayBlocks' => 'Blocks',
            'arraySteps' => 'Steps',
            'stepSize' => 'Step size',
            'hexagon' => 'Hexagon',
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
		$criteria->compare('sliderTextureURL',$this->sliderTextureURL,true);
		$criteria->compare('sliderLineURL',$this->sliderLineURL,true);
		$criteria->compare('subLineImage',$this->subLineImage,true);
		$criteria->compare('arrayBlocks',$this->arrayBlocks,true);
    	$criteria->compare('arraySteps',$this->arraySteps,true);
		$criteria->compare('stepSize',$this->stepSize,true);
		$criteria->compare('hexagon',$this->hexagon,true);
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
