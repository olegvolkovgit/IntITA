<?php

/**
 * This is the model class for table "user_teacher_consultant".
 *
 * The followings are the available columns in table 'user_teacher_consultant':
 * @property integer $id_user
 * @property string $start_date
 * @property string $end_date
 * @property integer $capacity
 *
 * The followings are the available model relations:
 * @property StudentReg $idUser
 */
class UserTeacherConsultant extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_teacher_consultant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, start_date', 'required'),
			array('id_user, capacity', 'numerical', 'integerOnly'=>true),
			array('end_date', 'safe'),
			// The following rule is used by search().
			array('id_user, start_date, end_date, capacity', 'safe', 'on'=>'search'),
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
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'capacity' => 'Capacity',
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('capacity',$this->capacity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserTeacherConsultant the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Used in admin cabinet.
     * @return string JSON for datatable (teacher consultants) in admin cabinet
     */
	public static function teacherConsultantsList(){
		$sql = 'select * from user as u, user_teacher_consultant as ua where u.id = ua.id_user';
		$admins = Yii::app()->db->createCommand($sql)->queryAll();
		$return = array('data' => array());

		foreach ($admins as $record) {
			$row = array();
			$row["id"]=$record["id"];
			$row["name"]["name"] = trim($record["secondName"]." ".$record["firstName"]." ".$record["middleName"]);
			$row["name"]["title"] = addslashes($record["secondName"]." ".$record["firstName"]." ".$record["middleName"]);
			$row["email"]["title"] = $record["email"];
			$row["email"]["url"] = $row["name"]["url"] = Yii::app()->createUrl('/_teacher/_admin/teachers/showTeacher',
				array('id' => $record['id']));
			$row["register"] = ($record["start_date"] > 0) ? date("d.m.Y",  strtotime($record["start_date"])):"невідомо";
			$row["cancelDate"] = ($record["end_date"]) ? date("d.m.Y", strtotime($record["end_date"])) : "";
			$row["profile"] = Config::getBaseUrl()."/profile/".$record["id"];
			$row["mailto"] = Yii::app()->createUrl('/_teacher/cabinet/index', array(
				'scenario' => 'message',
				'receiver' => $record["id"]
			));
			$row["cancel"] = Yii::app()->createUrl('/_teacher/_admin/users/cancelRole');
			array_push($return['data'], $row);
		}

		return json_encode($return);
	}

    /**
     * Used in content manager cabinet.
     * @return string JSON for datatable (teacher consultants) in content manager cabinet
     */
	public static function teacherConsultantsListCM(){
		$sql = 'select * from user as u, user_teacher_consultant as ua where u.id = ua.id_user';
		$admins = Yii::app()->db->createCommand($sql)->queryAll();
		$return = array('data' => array());

		foreach ($admins as $record) {
			$row = array();
			$row["name"]["name"] = trim($record["secondName"]." ".$record["firstName"]." ".$record["middleName"]);
			$row["name"]["title"] = addslashes($record["secondName"]." ".$record["firstName"]." ".$record["middleName"]);
			$row["email"]["title"] = $record["email"];
            $row["email"]["url"] = $row["name"]["url"] = Yii::app()->createUrl('/_teacher/_content_manager/contentManager/showTeacher',
                    array('id' => $record['id']));
			$row["register"] = ($record["start_date"] > 0) ? date("d.m.Y",  strtotime($record["start_date"])):"невідомо";
			$row["cancelDate"] = ($record["end_date"]) ? date("d.m.Y", strtotime($record["end_date"])) : "";
			$row["profile"] = Config::getBaseUrl()."/profile/".$record["id"];
			$row["cancel"] = "'".Yii::app()->createUrl('/_teacher/_content_manager/contentManager/cancelRole')."'".", 'teacher_consultant', '".$record["id"]."'";
			array_push($return['data'], $row);
		}

		return json_encode($return);
	}
}
