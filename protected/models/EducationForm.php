<?php

/**
 * This is the model class for table "education_form".
 *
 * The followings are the available columns in table 'education_form':
 * @property integer $id
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 *
 * The followings are the available model relations:
 * @property Service[] $services
 */
class EducationForm extends CActiveRecord
{
    const ONLINE = 1;
    const OFFLINE = 2;
	const ONLINE_OFFLINE = 3;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'education_form';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ua, title_ru, title_en', 'required'),
			array('title_ua, title_ru, title_en', 'length', 'max'=>30),
			// The following rule is used by search().
			array('id, title_ua, title_ru, title_en', 'safe', 'on'=>'search'),
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
			'services' => array(self::HAS_MANY, 'Service', 'education_form'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title_ua' => 'Title Ua',
			'title_ru' => 'Title Ru',
			'title_en' => 'Title En',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title_ua',$this->title_ua,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_en',$this->title_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EducationForm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function isOnline(){
		return $this->id == self::ONLINE;
	}

	public function isOffline(){
		return $this->id == self::OFFLINE;
	}

    public function getCoefficient() {
        if ($this->id == self::OFFLINE) {
            return Config::getCoeffModuleOffline();
        }
        return 1;
    }
}
