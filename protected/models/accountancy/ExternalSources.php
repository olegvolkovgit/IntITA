<?php

/**
 * This is the model class for table "acc_external_sources".
 *
 * The followings are the available columns in table 'acc_external_sources':
 * @property string $id
 * @property string $name
 * @property integer $cash
 *
 * The followings are the available model relations:
 * @property ExternalPays[] $externalPays
 */
class ExternalSources extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_external_sources';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'unique', 'message' => 'Джерело з такою назвою вже існує'),
			array('cash', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>512),
			// The following rule is used by search().
			array('id, name, cash', 'safe', 'on'=>'search'),
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
			'externalPays' => array(self::HAS_MANY, 'ExternalPays', 'sourceId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Ім\'я',
			'cash' => 'Гроші',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('cash',$this->cash);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExternalSources the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function canDelete()
    {
        $model = $this->externalPays;
        if($model)
            return true;
        else
            return false;
    }

	public function getValidationErrors() {
		$errors=[];
		foreach($this->getErrors() as $key=>$attribute){
			foreach($attribute as $error){
				array_push($errors,$error);
			}
		}
		return implode(", ", $errors);
	}
}
