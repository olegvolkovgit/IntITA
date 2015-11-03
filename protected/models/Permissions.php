<?php

/**
 * This is the model class for table "permissions".
 *
 * The followings are the available columns in table 'permissions':
 * @property integer $id_user
 * @property integer $id_resource
 * @property integer $rights
 */
//Flags for bits mask - right's array in db
//define('U_READ', 1 << 0);      // 0000 0001  view resource
//define('U_EDIT', 1 << 1);      // 0000 0010  edit resource
//define('U_CREATE', 1 << 2);    // 0000 0100  create resource
//define('U_DELETE', 1 << 3);     // 0000 1000  delete resource
//define ('U_ALL', U_READ | U_CREATE | U_EDIT | U_DELETE); // 1111 all permissions

class Permissions extends CActiveRecord
{

    public $User;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'permissions';
	}


    public function _construct(){
        $this->User = 1;
    }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_resource, rights', 'required'),
			array('id_user, id_resource, rights', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, id_resource, rights', 'safe', 'on'=>'search'),
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
			'id_user' => 'Id User',
			'id_resource' => 'Id Resource',
			'rights' => 'Rights',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_resource',$this->id_resource);
		$criteria->compare('rights',$this->rights);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Permissions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /*
     * Returns bit mask for change user permissions
     * @param array $rights array of rights for user (allowed read, edit, create, delete)
     * */

    public function primaryKey()
    {
        return array('id_user', 'id_resource');
    }


}
