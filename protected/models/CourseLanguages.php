<?php

/**
 * This is the model class for table "course_languages".
 *
 * The followings are the available columns in table 'course_languages':
 * @property integer $id
 * @property integer $lang_ua
 * @property integer $lang_ru
 * @property integer $lang_en
 *
 * The followings are the available model relations:
 * @property Course $langRu
 * @property Course $langUa
 * @property Course $langEn
 */
class CourseLanguages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'course_languages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lang_ua, lang_ru, lang_en', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
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
			'langRu' => array(self::BELONGS_TO, 'Course', 'lang_ru'),
			'langUa' => array(self::BELONGS_TO, 'Course', 'lang_ua'),
			'langEn' => array(self::BELONGS_TO, 'Course', 'lang_en'),
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
	 * @return CourseLanguages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function cancelLinkedCourse($lang){
        $param = 'lang_'.$lang;
        $this->$param = null;
        if($this->save()){
            if($this->isOneDefined()){
                $this->delete();
            }
            return true;
        } else {
            return false;
        }
    }

    public function isOneDefined(){
        $coursesDefined = 0;
        foreach(array("lang_ua", "lang_ru", "lang_en") as $item){
            if($this->$item > 0) $coursesDefined++;
        }
        return ($coursesDefined > 1)?false:true;
    }
}
