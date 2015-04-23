<?php

/**
 * This is the model class for table "header".
 *
 * The followings are the available columns in table 'header':
 * @property integer $headerID
 * @property string $language
 * @property string $logoURL
 * @property string $smallLogoURL
 * @property string $menuItem1
 * @property string $item1Link
 * @property string $menuItem2
 * @property string $item2Link
 * @property string $menuItem3
 * @property string $item3Link
 * @property string $menuItem4
 * @property string $item4Link
 * @property string $enterButtonText
 * @property string $logoutButtonText
 *
 * The followings are the available model relations:
 * @property Header[] $headers
 */
class Header extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language, logoURL, smallLogoURL, menuItem1, item1Link, menuItem2, item2Link, menuItem3, item3Link, menuItem4, item4Link, enterButtonText, logoutButtonText', 'required'),
			array('language', 'length', 'max'=>2),
			array('logoURL, smallLogoURL, item1Link, item2Link, item3Link, item4Link', 'length', 'max'=>255),
			array('menuItem1, menuItem2, menuItem3, menuItem4, enterButtonText, logoutButtonText', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('headerID, language, logoURL, smallLogoURL, menuItem1, item1Link, menuItem2, item2Link, menuItem3, item3Link, menuItem4, item4Link, enterButtonText, logoutButtonText', 'safe', 'on'=>'search'),
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
			'headerlangs' => array(self::HAS_MANY, 'Headerlang', 'header_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'headerID' => 'Header',
			'language' => 'Language',
			'logoURL' => 'Logo Url',
			'smallLogoURL' => 'Small Logo Url',
			'menuItem1' => 'Menu Item1',
			'item1Link' => 'Item1 Link',
			'menuItem2' => 'Menu Item2',
			'item2Link' => 'Item2 Link',
			'menuItem3' => 'Menu Item3',
			'item3Link' => 'Item3 Link',
			'menuItem4' => 'Menu Item4',
			'item4Link' => 'Item4 Link',
			'enterButtonText' => 'Enter Button Text',
			'logoutButtonText' => 'Logout Button Text',
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

		$criteria->compare('headerID',$this->headerID);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('logoURL',Yii::app()->request->baseUrl.$this->logoURL,true);
		$criteria->compare('smallLogoURL',Yii::app()->request->baseUrl.$this->smallLogoURL,true);
		$criteria->compare('menuItem1',$this->menuItem1,true);
		$criteria->compare('item1Link',$this->item1Link,true);
		$criteria->compare('menuItem2',$this->menuItem2,true);
		$criteria->compare('item2Link',$this->item2Link,true);
		$criteria->compare('menuItem3',$this->menuItem3,true);
		$criteria->compare('item3Link',$this->item3Link,true);
		$criteria->compare('menuItem4',$this->menuItem4,true);
		$criteria->compare('item4Link',$this->item4Link,true);
		$criteria->compare('enterButtonText',$this->enterButtonText,true);
		$criteria->compare('logoutButtonText',$this->logoutButtonText,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Header the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getMenuItem1(){
        return Yii::t('header', '0016');
    }

    public function getMenuItem2(){
        return Yii::t('header', '0021');
    }

    public function getMenuItem3(){
        return Yii::t('header', '0017');
    }

    public function getMenuItem4(){
        return Yii::t('header', '0018');
    }

    public function getEnterButton(){
        return Yii::t('header', '0019');
    }

    public function getLogoutButton(){
        return Yii::t('header', '0020');
    }
}
