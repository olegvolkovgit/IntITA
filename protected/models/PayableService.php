<?php

/**
 * This is the model class for table "acc_service".
 *
 * The followings are the available columns in table 'acc_service':
 * @property string $service_id
 * @property string $description
 * @property string $create_date
 * @property integer $cancelled
 * @property integer $billable
 *
 * The followings are the available model relations:
 * @property CourseService[] $courseServices
 * @property InternalPays[] $internalPays
 * @property ModuleService[] $moduleServices
 */
class PayableService extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, create_date', 'required'),
			array('cancelled, billable', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('service_id, description, create_date, cancelled, billable', 'safe', 'on'=>'search'),
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
			'courseServices' => array(self::HAS_MANY, 'CourseService', 'service_id'),
			'internalPays' => array(self::HAS_MANY, 'InternalPays', 'service_id'),
			'moduleServices' => array(self::HAS_MANY, 'ModuleService', 'service_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'service_id' => 'Service code',
			'description' => 'service description',
			'create_date' => 'service creation date',
			'cancelled' => 'Is cancelled',
			'billable' => 'Is billable',
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

		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('cancelled',$this->cancelled);
		$criteria->compare('billable',$this->billable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayableService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
