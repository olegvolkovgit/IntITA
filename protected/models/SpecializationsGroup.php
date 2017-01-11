<?php

/**
 * This is the model class for table "specializations_group".
 *
 * The followings are the available columns in table 'specializations_group':
 * @property integer $id
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 *
 */
class SpecializationsGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'specializations_group';
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
			array('title_ua, title_ru, title_en', 'length', 'max'=>128),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title_ua' => 'Назва спеціалізації (укр.)',
			'title_ru' => 'Назва спеціалізації (рос.)',
			'title_en' => 'Назва спеціалізації (англ.)',
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
	 * @return SpecializationsGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function specializationsList(){
		$param = Yii::app()->session["lg"]?"title_".Yii::app()->session["lg"]:"title_ua";
		$criteria = new CDbCriteria();
		$specializations = SpecializationsGroup::model()->findAll($criteria);
		$data = array();

		foreach ($specializations as $key=>$specialization) {
			$data[$key]['id']=$specialization['id'];
			$data[$key]['title']=$specialization[$param];
			$data[$key]['title_ua']=$specialization['title_ua'];
			$data[$key]['title_ru']=$specialization['title_ru'];
			$data[$key]['title_en']=$specialization['title_en'];
		}

		return json_encode($data);
	}
}