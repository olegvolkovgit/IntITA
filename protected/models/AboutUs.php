<?php

/**
 * This is the model class for table "aboutus".
 *
 * The followings are the available columns in table 'aboutus':
 * @property integer $block_id
 * @property string $line2Image
 * @property string $iconImage
 * @property string $titleText
 * @property string $textAbout
 * @property string $linkAddress
 * @property string $imagesPath
 * @property string $drop1Text
 * @property string $drop2Text
 * @property string $drop3Text
 * @property string $dropName
 */
class Aboutus extends CActiveRecord
{
    public $titleText1, $titleText2, $titleText3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aboutus';
	}

	function AboutUs($id){

	}

	public function setValuesById($id)
	{
		$this->line2Image=Yii::app()->request->baseUrl.$this->findByPk($id)->line2Image;
		$this->iconImage=Yii::app()->request->baseUrl.$this->findByPk($id)->imagesPath.$this->findByPk($id)->iconImage;
		//$this->titleText=Yii::t('aboutus', '');
		//$this->textAbout=$this->findByPk($id)->textAbout;
		$this->linkAddress=Yii::app()->request->baseUrl.$this->findByPk($id)->linkAddress;
        return 'aboutus';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('line2Image, iconImage, titleText, textAbout, linkAddress, imagesPath, drop1Text, drop2Text, drop3Text, dropName', 'required'),
			array('line2Image, iconImage, textAbout, linkAddress, imagesPath', 'length', 'max'=>255),
			array('titleText, dropName', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('block_id, line2Image, iconImage, titleText, textAbout, linkAddress, imagesPath, drop1Text, drop2Text, drop3Text, dropName', 'safe', 'on'=>'search'),
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

    public function setStartBlock(){
        $this->isStart = true;
        $this->redirect(array('studentreg/index'));
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'block_id' => 'Block',
			'line2Image' => 'Line2 Image',
			'iconImage' => 'Icon Image',
			'titleText' => 'Title Text',
			'textAbout' => 'Text About',
			'linkAddress' => 'Link Address',
			'imagesPath' => 'Images Path',
			'drop1Text' => 'Drop1 Text',
			'drop2Text' => 'Drop2 Text',
			'drop3Text' => 'Drop3 Text',
			'dropName' => 'Drop Name',
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

		$criteria->compare('block_id',$this->block_id);
		$criteria->compare('line2Image',$this->line2Image,true);
		$criteria->compare('iconImage',$this->iconImage,true);
		$criteria->compare('titleText',$this->titleText,true);
		$criteria->compare('textAbout',$this->textAbout,true);
		$criteria->compare('linkAddress',$this->linkAddress,true);
		$criteria->compare('imagesPath',$this->imagesPath,true);
		$criteria->compare('drop1Text',$this->drop1Text,true);
		$criteria->compare('drop2Text',$this->drop2Text,true);
		$criteria->compare('drop3Text',$this->drop3Text,true);
		$criteria->compare('dropName',$this->dropName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Aboutus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
