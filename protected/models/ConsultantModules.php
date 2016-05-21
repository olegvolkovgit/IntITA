<?php

/**
 * This is the model class for table "consultant_modules".
 *
 * The followings are the available columns in table 'consultant_modules':
 * @property integer $id
 * @property integer $consultant
 * @property integer $module
 * @property string $start_time
 * @property string $end_time
 *
 * The followings are the available model relations:
 * @property Module $module0
 * @property Teacher $consultant0
 */
class ConsultantModules extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consultant_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('consultant, module', 'required'),
			array('consultant, module', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, consultant, module, start_time, end_time', 'safe', 'on'=>'search'),
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
			'module0' => array(self::BELONGS_TO, 'Module', 'module'),
			'consultant0' => array(self::BELONGS_TO, 'Teacher', 'consultant'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'consultant' => 'Consultant',
			'module' => 'Module',
            'start_time' => 'Start time',
            'end_time' => 'End time'
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('consultant',$this->consultant);
		$criteria->compare('module',$this->module);
        $criteria->compare('start_time',$this->start_time);
        $criteria->compare('end_time',$this->end_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConsultantModules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
