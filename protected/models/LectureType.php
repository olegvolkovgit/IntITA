<?php

/**
 * This is the model class for table "lecture_type".
 *
 * The followings are the available columns in table 'lecture_type':
 * @property integer $id
 * @property string $image
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 * @property string $short
 * @property string $description
 *
  * The followings are the available model relations:
 * @property Lecture[] $lectures
 */
class LectureType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lecture_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image, title_ua, title_ru, title_en, short, description', 'required'),
			array('image, description', 'length', 'max'=>255),
			array('title_ua, title_ru, title_en', 'length', 'max'=>50),
			array('short', 'length', 'max'=>5),
			// The following rule is used by search().
			array('id, image, title_ua, title_ru, title_en, short, description', 'safe', 'on'=>'search'),
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
            'lectures' => array(self::HAS_MANY, 'Lectures', 'idType'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'image' => 'Image',
			'title_ua' => 'Title Ua',
			'title_ru' => 'Title Ru',
			'title_en' => 'Title En',
			'short' => 'Short',
			'description' => 'Description',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('title_ua',$this->title_ua,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('short',$this->short,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LectureType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function allTypeByLang($lg = 'ua'){
		$param = "title_".$lg;
		$criteria = new CDbCriteria();
		$criteria->select = 'id, '.$param;
		$types =  LectureType::model()->findAll($criteria);
		$result = [];
		foreach($types as $type){
			$result[$type->id] = $type->$param;
		}
		return $result;
	}
}
