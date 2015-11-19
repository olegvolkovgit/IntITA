<?php

/**
 * This is the model class for table "acc_operation_type".
 *
 * The followings are the available columns in table 'acc_operation_type':
 * @property integer $id
 * @property string $description
 * @property integer $negative_summa
 *
 * The followings are the available model relations:
 * @property Operation[] $accOperations
 */
class OperationType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_operation_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('negative_summa', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, negative_summa', 'safe', 'on'=>'search'),
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
			'operations' => array(self::HAS_MANY, 'Operation', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Код типу',
			'description' => 'Опис',
			'negative_summa' => 'Negative Summa',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('negative_summa',$this->negative_summa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OperationType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public static function getTypesList(){
        $types = OperationType::model()->findAll();
        return $types;
    }

    public static function getDescription($id){
        return OperationType::model()->findByPk($id)->description;
    }
}
