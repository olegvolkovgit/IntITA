<?php

/**
 * This is the model class for table "level".
 *
 * The followings are the available columns in table 'level':
 * @property integer $id
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 *
 * The followings are the available model relations:
 * @property Course[] $courses
 * @property Module[] $modules
 */
class Level extends CActiveRecord
{
	const INTERN = 1;
	const JUNIOR = 2;
	const STRONG_JUNIOR = 3;
	const MIDDLE = 4;
	const SENIOR = 5;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'level';
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
			array('title_ua, title_ru, title_en', 'length', 'max'=>50),
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
			'courses' => array(self::HAS_MANY, 'Course', 'level'),
			'modules' => array(self::HAS_MANY, 'Module', 'level'),
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
	 * @return Level the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function primaryKey(){
		return 'id';
	}

	public static function allTitlesByLang($lg = 'ua'){
        $param = "title_".$lg;
        $criteria = new CDbCriteria();
        $criteria->select = 'id, '.$param;
        $levels =  Level::model()->findAll($criteria);
        $result = [];
        foreach($levels as $level){
            $result[$level->id] = $level->$param;
        }
        return $result;
    }

	public function edit($titleUa, $titleRu, $titleEn){
        $this->title_ua = $titleUa;
        $this->title_ru = $titleRu;
        $this->title_en = $titleEn;

        Yii::app()->cache->flush();
        return $this->update(array('title_ua','title_ru','title_en'));
    }
}
