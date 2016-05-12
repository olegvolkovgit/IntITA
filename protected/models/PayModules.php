<?php

/**
 * This is the model class for table "pay_modules".
 *
 * The followings are the available columns in table 'pay_modules':
 * @property integer $id_user
 * @property integer $id_module
 * @property integer $rights
 *
 * The followings are the available model relations:
 * @property Module $module
 * @property StudentReg $idUser
 */

//Flags for bits mask - right's array in db
//define('U_READ', 1 << 0);      // 0000 0001  view resource
//define('U_EDIT', 1 << 1);      // 0000 0010  edit resource
//define('U_CREATE', 1 << 2);    // 0000 0100  create resource
//define('U_DELETE', 1 << 3);     // 0000 1000  delete resource
//define ('U_ALL', U_READ | U_CREATE | U_EDIT | U_DELETE); // 1111 all permissions

class PayModules extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pay_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_module, rights', 'required'),
			array('id_user, id_module, rights', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_user, id_module, rights', 'safe', 'on'=>'search'),
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
			'module' => array(self::BELONGS_TO, 'Module', 'id_module'),
			'idUser' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'id_module' => 'Id Module',
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
		$criteria=new CDbCriteria;

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_module',$this->id_module);
		$criteria->compare('rights',$this->rights);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayModules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /*
     * Returns bit mask for change user permissions
     * @param array $rights array of rights for user (allowed read, edit, create, delete)
     * */
    public static function setFlags($rights){
        if(in_array('edit', $rights) && !in_array('read', $rights)){
            array_push($rights, 'read');
        }
        $flag = 0;
        for ($i = 0; $i < count($rights); $i++) {
            $right = $rights[$i];
            switch ($right) {
                case 'read':
                    $flag |= 1<<0;  // add to mask bit for right READ
                    break;
                case 'edit':
                    $flag |= 1 << 1;  // add to mask bit for right EDIT
                    break;
                case 'create':
                    $flag |= 1 << 2; // add to mask bit for right CREATE
                    break;
                case 'delete':
                    $flag |= 1 << 3; // add to mask bit for right DELETE
                    break;
                default:
                    $flag = 0;
                }
        }
        return $flag;
    }

    public static function getFlags($rights){
        $rightsString = [];
        for ($i = 0; $i < count($rights); $i++) {
            if ($rights[$i] == 1){
                array_push($rightsString, Permissions::model()->stringRight([$i]));
            }
        }
        return $rightsString;
    }


    /*
     * Returns true if user has permission to do requested operations with resource
     * @param integer $idUser user
     * @param integer $idResource resource
     * @param array $rights array of rights for user (allowed read, edit, create, delete)
     * */
    public function checkModulePermission($idUser, $idResource, $rights){
        $recordModule = $this->findByPk(array('id_user' => $idUser,
            'id_module' => $idResource));
        if (is_null($recordModule)) {
            $courses = CourseModules::model()->findAllByAttributes(array('id_module' => $idResource));
            foreach($courses as $course){
                if(PayCourses::model()->checkCoursePermission($idUser, $course->id_course, $rights))
                return true;
            }
            return false;
        } else {
            $mask = $this->setFlags($rights);
            if ($recordModule->rights & $mask){
                return true;
            }else {
                $courses = CourseModules::model()->findAllByAttributes(array('id_module' => $idResource));
                foreach($courses as $course){
                    if(PayCourses::model()->checkCoursePermission($idUser, $course->id_course, $rights))
                        return true;
                }
                return false;
            }

        }
    }

    public function primaryKey()
    {
        return array('id_user', 'id_module');
    }

    /*
 * Set permission for one user to do defined operations with one resource.
 * @param integer $idUser unique user - getting access
 * @param integer $idResource
 * @param array $rights array of rights for user (allowed read, edit, create, delete)
 * */
    public function setModulePermission($idUser, $idResource, $rights){
        if(PayModules::model()->exists('id_user=:user and id_module=:resource', array(':user' => $idUser, ':resource' => $idResource)))
        {
            PayModules::model()->updateByPk(array('id_user'=>$idUser,'id_module'=> $idResource), array('rights' => PayModules::setFlags($rights)));
        }
        else
        {
            Yii::app()->db->createCommand()->insert('pay_modules', array(
                'id_user' => $idUser,
                'id_module' => $idResource,
                'rights' => PayModules::setFlags($rights),
            ));
        }
    }

    public function setModuleRead($idUser, $idResource){
        $model = new PayModules();
        if(PayModules::model()->exists('id_user=:user and id_module=:resource', array(':user' => $idUser, ':resource' => $idResource))) {
            $model = PayModules::model()->findByAttributes(array('id_user' => $idUser, 'id_module' => $idResource));
            $rights = $model->rights | 1 << 0;
            PayModules::model()->updateByPk(array('id_user'=>$idUser,'id_module'=> $idResource), array('rights' => $rights));
        } else {
            $model->setModulePermission($idUser, $idResource, array('read'));
        }
    }

    public static function unsetModulePermission($idUser, $idResource, $rights){
        if(PayModules::model()->exists('id_user=:user and id_module=:resource', array(':user' => $idUser, ':resource' => $idResource)))
        {
           return PayModules::model()->updateByPk(array('id_user'=>$idUser,'id_module'=> $idResource), array('rights' => 0));
        }
    }

    public static function checkEditMode($idModule, $idUser)
    {
        $permission = new PayModules();
        if ($permission->checkModulePermission($idUser, $idModule, array('edit'))) {
            return true;
        } else {
            return false;
        }
    }

    public static function getConfirmText(Module $module,$userName)
    {
        $result = '<br /><h4>Вітаємо!</h4> Модуль <strong>'.
            $module->title_ua.', ('.$module->language.') оплачено</strong>.
            <br />Тепер у '.$userName.' є доступ до усіх занять цього модуля.';

        return $result;
    }

    public static function getExistPayModuleText($userName)
    {
        $result = 'У '.$userName.' вже <strong>Є</strong> доступ до цього модуля';

        return $result;
    }

    public static function getCancelText(Module $module,$userName)
    {
        $result = '<br />Тепер у '.$userName.' НЕМАЄ доступу до усіх занять модуля <b>'.$module->title_ua.', ('.$module->language.')</b>';

        return $result;
    }

    public static function getCancelErrorText($userName)
    {
        $result = '<br /> В користувача '. $userName. ' не було доступу до даного модуля';

        return $result;
    }

    public static function getPayModulesListByUser(){
        $criteria = new CDbCriteria;
        $criteria->addCondition('id_user=' . Yii::app()->user->getId());
        $modules = PayModules::model()->findAll($criteria);
        $return = array('data' => array());

        foreach ($modules as $record) {
            $row = array();

            $row["title"]["name"] = CHtml::encode($record->module->getTitle());
            $row["title"]["url"] = Yii::app()->createAbsoluteUrl("module/index", array("idModule" =>$record->module->module_ID));
            $row["summa"] = ($record->module->getBasePrice() != 0)?number_format(CommonHelper::getPriceUah($record->module->getBasePrice()), 2, ",","&nbsp;"): "безкоштовно";
            //$row["schema"] = CHtml::encode($record->paymentSchema->name);
            //$row["invoicesUrl"] = "'".Yii::app()->createUrl("payment/agreement", array("id" =>$record->id))."'";

            array_push($return['data'], $row);
        }

        return json_encode($return);
    }
}
