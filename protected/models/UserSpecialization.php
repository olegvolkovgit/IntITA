<?php

/**
 * This is the model class for table "user_specialization".
 *
 * The followings are the available columns in table 'user_specialization':
 * @property integer $id_user
 * @property integer $id_specialization
 *
 * The followings are the available model relations:
 */
class UserSpecialization extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_specialization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_specialization', 'required'),
			array('id_user, id_specialization', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_user, id_specialization', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
			'specialization' => array(self::BELONGS_TO, 'SpecializationsGroup', array('id_specialization'=>'id')),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id user',
			'id_specialization' => 'Id specialization',
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

        $criteria->compare('id_user',$this->id_user);
        $criteria->compare('id_specialization',$this->id_specialization,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserSpecialization the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey(){
        return array('id_user','id_specialization');
    }
}
