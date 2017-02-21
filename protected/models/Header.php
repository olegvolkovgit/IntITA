<?php

/**
 * This is the model class for table "header".
 *
 * The followings are the available columns in table 'header':
 * @property integer $headerID
 * @property string $logoURL
 * @property string $smallLogoURL
 * @property string $item1Link
 * @property string $item2Link
 * @property string $item3Link
 * @property string $item4Link
 */

class Header extends CActiveRecord
{
    const COURSES_ACTIVE = 1;
    const TEACHERS_ACTIVE = 2;
    const GRADUATES_ACTIVE = 3;
    const ABOUTUS_ACTIVE = 4;

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
			array('logoURL, smallLogoURL, item1Link, item2Link, item3Link, item4Link', 'required'),
			array('logoURL, smallLogoURL, item1Link, item2Link, item3Link, item4Link', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('headerID, logoURL, smallLogoURL, item1Link, item2Link, item3Link, item4Link', 'safe', 'on'=>'search'),
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
			'headerID' => 'Header',
			'logoURL' => 'Logo Url',
			'smallLogoURL' => 'Small Logo Url',
			'item1Link' => 'Item1 Link',
			'item2Link' => 'Item2 Link',
			'item3Link' => 'Item3 Link',
			'item4Link' => 'Item4 Link',
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
		$criteria->compare('logoURL',Yii::app()->request->baseUrl.$this->logoURL,true);
		$criteria->compare('smallLogoURL',Yii::app()->request->baseUrl.$this->smallLogoURL,true);
		$criteria->compare('item1Link',$this->item1Link,true);
		$criteria->compare('item2Link',$this->item2Link,true);
		$criteria->compare('item3Link',$this->item3Link,true);
		$criteria->compare('item4Link',$this->item4Link,true);

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

    public function getEnterButton(){
        return Yii::t('header', '0019');
    }

    public function getLogoutButton(){
        return Yii::t('header', '0020');
    }
//todo - write function, which will determinate page through id-controller and action

    public function currentPage()
    {
        $element = 0;
        switch (true) {
            case (Yii::app()->controller->id == 'courses') :
                $element = Header::COURSES_ACTIVE;
                break;
            case (Yii::app()->controller->id == 'teachers') :
                $element = Header::TEACHERS_ACTIVE;
                break;
            case (Yii::app()->controller->id == 'graduate') :
                $element = Header::GRADUATES_ACTIVE;
                break;
            case (Yii::app()->controller->id == 'aboutus') :
                $element = Header::ABOUTUS_ACTIVE;
                break;
            default:
                break;

        };
        return $element;
    }
}
