<?php

/**
 * This is the model class for table "pay_courses".
 *
 * The followings are the available columns in table 'pay_courses':
 * @property integer $id_user
 * @property integer $id_course
 * @property integer $rights
 *
 * The followings are the available model relations:
 * @property Course $course
 * @property StudentReg $idUser
 */

//Flags for bits mask - right's array in db
//define('U_READ', 1 << 0);      // 0000 0001  view resource
//define('U_EDIT', 1 << 1);      // 0000 0010  edit resource
//define('U_CREATE', 1 << 2);    // 0000 0100  create resource
//define('U_DELETE', 1 << 3);     // 0000 1000  delete resource
//define ('U_ALL', U_READ | U_CREATE | U_EDIT | U_DELETE); // 1111 all permissions


class PayCourses extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pay_courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_course, rights', 'required'),
			array('id_user, id_course, rights', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, id_course, rights', 'safe', 'on'=>'search'),
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
            'course' => array(self::BELONGS_TO, 'Course', 'id_course'),
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
			'id_course' => 'Id Course',
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
		$criteria->compare('t.id_course',$this->id_course);
		$criteria->compare('rights',$this->rights);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayCourses the static model class
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
        $flag = 0;
        for ($i = 0; $i < count($rights); $i++) {
            $right = $rights[$i];
            switch ($right) {
                case 'read':
                    $flag |= 1 << 0;  // add to mask bit for right READ
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
    public function checkCoursePermission($idUser, $idResource, $rights){
        $record = $this->findByPk(array('id_user' => $idUser,
            'id_course' => $idResource));
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

    public function primaryKey()
    {
        return array('id_user', 'id_course');
    }

    /*
 * Set permission for one user to do defined operations with one resource.
 * @param integer $idUser unique user - getting access
 * @param integer $idResource
 * @param array $rights array of rights for user (allowed read, edit, create, delete)
 * */
    public function setCoursePermission($idUser, $idResource, $rights){
        if(PayCourses::model()->exists('id_user=:user and id_course=:resource', array(':user' => $idUser, ':resource' => $idResource)))
        {
            PayCourses::model()->updateByPk(array('id_user'=>$idUser,'id_course'=> $idResource), array('rights' => PayCourses::setFlags($rights)));
        }
        else
        {
            Yii::app()->db->createCommand()->insert('pay_courses', array(
                'id_user' => $idUser,
                'id_course' => $idResource,
                'rights' => PayCourses::setFlags($rights),
            ));
        }
    }
    public function setCourseRead($idUser, $idResource){
        $model = new PayCourses();
        if(PayCourses::model()->exists('id_user=:user and id_course=:resource', array(':user' => $idUser, ':resource' => $idResource))) {
            $model = PayCourses::model()->findByAttributes(array('id_user' => $idUser, 'id_course' => $idResource));
            $rights = $model->rights | 1 << 0;
            PayCourses::model()->updateByPk(array('id_user'=>$idUser,'id_course'=> $idResource), array('rights' => $rights));
        } else {
            $model->setCoursePermission($idUser, $idResource, array('read'));
        }
    }


    public static function getCancelText(Course $course,$userName)
    {
        $result = '<strong> Доступ до курсу '.
            $course->title_ua.', ('.$course->language.') скасовано</strong>.
                    <br />Тепер у '.$userName.' НЕМАЄ доступу до усіх занять цього курсу.';

        return $result;
    }

    public static function getCancelErrorText($userName)
    {
        $result = '<br /> В користувача '. $userName. ' не було доступу до даного куру на індивідуальному рівні';

        return $result;
    }

    public static function getConfirmText(Course $course,$userName)
    {
        $result = '<br /><h4>Вітаємо!</h4> Курс <strong>'.
            $course->title_ua.', ('.$course->language.') оплачено</strong>.
            <br />Тепер у '.$userName.' є доступ до усіх занять цього курсу.';
        return $result;
    }

    public static function getPayCoursesListByUser(){
        $criteria = new CDbCriteria;
        $criteria->addCondition('id_user=' . Yii::app()->user->getId());
        $modules = PayCourses::model()->findAll($criteria);
        $return = array('data' => array());

        foreach ($modules as $record) {
            $row = array();

            $row["title"]["name"] = $record->course->cancelled?$record->course->getTitle().'(скасований)':$record->course->getTitle();
            $row["title"]["url"] = $record->course->cancelled?'':Yii::app()->createAbsoluteUrl("course/index", array("id" =>$record->course->course_ID));
            $row["summa"] = ($record->course->getBasePrice() != 0)? number_format(CommonHelper::getPriceUah($record->course->getBasePrice()), 2, ",","&nbsp;"): "безкоштовно";
            //$row["schema"] = CHtml::encode($record->paymentSchema->name);
            //$row["invoicesUrl"] = "'".Yii::app()->createUrl("payment/agreement", array("id" =>$record->id))."'";

            array_push($return['data'], $row);
        }

        return json_encode($return);
    }
}
