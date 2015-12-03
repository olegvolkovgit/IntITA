<?php

/**
 * This is the model class for table "roles".
 *
 * The followings are the available columns in table 'roles':
 * @property integer $id
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 * @property string $description
 *
 * The followings are the available model relations:
 * @property AttributeValue[] $attributeValues
 * @property TeacherRoles[] $teacherRoles
 */
class Roles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ua, title_ru, title_en, description', 'required'),
			array('title_ua, title_ru, title_en', 'length', 'max'=>20),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title_ua, title_ru, title_en, description', 'safe', 'on'=>'search'),
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
			'roleAttributes' => array(self::HAS_MANY, 'RoleAttribute', 'role'),
			'teacherRoles' => array(self::HAS_MANY, 'TeacherRoles', 'role'),
            'attributeValues' => array(self::HAS_MANY, 'AttributeValue', 'role'),
            'attribute_values' => array(self::HAS_MANY, 'AttributeValue', 'id',
                'order'=>'attribute.sort ASC',
                'with'=>'attribute',
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title_ua' => 'Назва українською',
			'title_ru' => 'Назва російською',
			'title_en' => 'Назва англійською',
			'description' => 'Короткий опис',
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
		$criteria->compare('title_ua',$this->title_ua,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Roles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function generateRolesList()
    {
        $roles = Roles::model()->findAll();
        $count = count($roles);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $roles[$i]->id;
            $result[$i]['alias'] = $roles[$i]->title_ua;
        }
        return $result;
    }
}
