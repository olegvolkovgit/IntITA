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
define('U_READ', 1 << 0);      // 0000 0001  view resource
define('U_EDIT', 1 << 1);      // 0000 0010  edit resource
define('U_CREATE', 1 << 2);    // 0000 0100  create resource
define('U_DELETE', 1 << 3);     // 0000 1000  delete resource
define ('U_ALL', U_READ | U_CREATE | U_EDIT | U_DELETE); // 1111 all permissions

class Permissions extends CActiveRecord
{


    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'permissions';
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
		$criteria->compare('rights',$this->rigths);

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
		return parent::model();
	}

    /*
     * Set permission for one user to do defined operations with one resource.
     * @param integer $idUser unique user - getting access
     * @param integer $idResource
     * @param array $rights array of rights for user (allowed read, edit, create, delete)
     * */
    public function setPermission($idUser, $idResource, $rights){
        // find record in permission table by user id and resource id !!!
        $record = $this->findByAttributes(array('id_user' => $idUser,
            'id_resource' => $idResource));
        // if record not found, create new record
        if (!$record){
            $record = new Permissions();
            $record->id_user = $idUser;
            $record->id_resource = $idResource;
        }
        // set right in bit mask with logic operation OR and bit's flag
        $record->rights |= $this->setFlags($rights);
        $record->save(); //write record in db
        return true;
    }

    /*
     * Returns bit mask for change user permissions
     * @param array $rights array of rights for user (allowed read, edit, create, delete)
     * */
    public static function setFlags($rights){
        $flag = 0;
        for ($i = 0; $i < count($rights); $i++) {
            $right = $rights[$i];
            switch ($right) {
                case 'read':
                    $flag |= U_READ;  // add to mask bit for right READ
                    break;
                case 'edit':
                    $flag |= U_EDIT;  // add to mask bit for right EDIT
                    break;
                case 'create':
                    $flag |= U_CREATE; // add to mask bit for right CREATE
                    break;
                case 'delete':
                    $flag |= U_DELETE; // add to mask bit for right DELETE
                    break;
                default:
                    throw new CHttpException(500, 'Permisssions::setRight:  Invalid param $rights');
            }
        }
        return $flag;
    }


    /*
     * Returns true if user has permission to do requested operations with resource
     * @param integer $idUser user
     * @param integer $idResource resource
     * @param array $rights array of rights for user (allowed read, edit, create, delete)
     * */
    public function checkPermission($idUser, $idResource, $rights){
        $record = $this->findByAttributes(array('id_user' => $idUser,
                'id_resource' => $idResource));
        if (is_null($record)) {
            return false;
        } else {
            $mask = $this->setFlags($rights);
            if ($record->rights & $mask){
                return true;
            }else {
                return false;
            }

        }
    }

    public function deletePermission($idUser, $idResource, $rights){

    }
}
