<?php

/**
 * This is the model class for table "module_languages".
 *
 * The followings are the available columns in table 'module_languages':
 * @property integer $id
 * @property integer $lang_ua
 * @property integer $lang_ru
 * @property integer $lang_en
 *
 * The followings are the available model relations:
 * @property Module $langUa
 * @property Module $langRu
 */
class ModuleLanguages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module_languages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lang_ua, lang_ru, lang_en', 'required'),
			array('lang_ua, lang_ru, lang_en', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lang_ua, lang_ru, lang_en', 'safe', 'on'=>'search'),
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
			'langUa' => array(self::BELONGS_TO, 'Module', 'lang_ua'),
			'langRu' => array(self::BELONGS_TO, 'Module', 'lang_ru'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lang_ua' => 'Lang Ua',
			'lang_ru' => 'Lang Ru',
			'lang_en' => 'Lang En',
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
		$criteria->compare('lang_ua',$this->lang_ua);
		$criteria->compare('lang_ru',$this->lang_ru);
		$criteria->compare('lang_en',$this->lang_en);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModuleLanguages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
