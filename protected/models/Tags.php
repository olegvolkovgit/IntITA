<?php

/**
 * This is the model class for table "tags".
 *
 * The followings are the available columns in table 'tags':
 * @property integer $id
 * @property string $tag_ua
 * @property string $tag_ru
 * @property string $tag_en
 *
 * The followings are the available model relations:
 * @property Module[] $modules
 */
class Tags extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag_ua, tag_ru, tag_en', 'required'),
			array('tag_ua, tag_ru, tag_en', 'length', 'max'=>50),
			// The following rule is used by search().
			array('id, tag_ua, tag_ru, tag_en', 'safe', 'on'=>'search'),
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
			'tagModules' => array(self::HAS_MANY, 'ModuleTags', 'id_tag','with' => 'lecture'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tag_ua' => 'Tag Ua',
			'tag_ru' => 'Tag Ru',
			'tag_en' => 'Tag En',
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
		$criteria->compare('tag_ua',$this->tag_ua,true);
		$criteria->compare('tag_ru',$this->tag_ru,true);
		$criteria->compare('tag_en',$this->tag_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function primaryKey(){
		return 'id';
	}

	public static function tagsList(){
		$lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
		$param = "tag_" . $lang;
		$tags=Tags::model()->findAll(array('order'=>$param));
		$data=array();
		foreach ($tags as $key=>$tag) {
			$data[$key]['id']=$tag['id'];
			$data[$key]['tag']=$tag[$param];
		}

		return json_encode($data);
	}
}
