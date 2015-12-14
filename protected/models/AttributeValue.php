<?php

/**
 * This is the model class for table "attribute_value".
 *
 * The followings are the available columns in table 'attribute_value':
 * @property integer $id
 * @property integer $teacher
 * @property integer $attribute
 * @property string $value
 *
 * The followings are the available model relations:
 * @property RoleAttribute $attribute0
 * @property Teacher $teacher0
 */
class AttributeValue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attribute_value';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacher, attribute, value', 'required'),
			array('teacher, attribute', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, teacher, attribute, value', 'safe', 'on'=>'search'),
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
			'attribute0' => array(self::BELONGS_TO, 'RoleAttribute', 'attribute'),
			'teacher0' => array(self::BELONGS_TO, 'Teacher', 'teacher'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'teacher' => 'Teacher',
			'attribute' => 'Attribute',
			'value' => 'Value',
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
		$criteria->compare('teacher',$this->teacher);
		$criteria->compare('attribute',$this->attribute);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AttributeValue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function setRoleAttribute($teacher, $attribute, $value){
        $result = false;
        if (AttributeValue::model()->exists('teacher=:teacher and attribute=:attribute', array('teacher'=>$teacher, 'attribute'=>$attribute))){
            $model = AttributeValue::model()->findByAttributes(array('teacher'=>$teacher, 'attribute'=>$attribute));
        } else{
            $model = new AttributeValue();
            $model->teacher = $teacher;
            $model->attribute = $attribute;
        }
        $model->value = $value;
        if ($model->validate()){
            $model->save();
            $result = true;
        }
        return $result;
    }
}
