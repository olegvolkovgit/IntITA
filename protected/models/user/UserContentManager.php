<?php

/**
 * This is the model class for table "user_content_manager".
 *
 * The followings are the available columns in table 'user_content_manager':
 * @property integer $id_user
 * @property string $start_date
 * @property string $end_date
 *
 * The followings are the available model relations:
 * @property StudentReg $idUser
 */
class UserContentManager extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_content_manager';
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
			array('id_user', 'numerical', 'integerOnly'=>true),
			array('end_date', 'safe'),
			// The following rule is used by search().
			array('id_user, start_date, end_date', 'safe', 'on'=>'search'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserContentManager the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function contentManagersList(){
		$sql = 'select * from user as u, user_content_manager as ua where u.id = ua.id_user';
		$admins = Yii::app()->db->createCommand($sql)->queryAll();
		$return = array('data' => array());

		foreach ($admins as $record) {
			$row = array();
			$row["name"]["title"] = $record["secondName"]." ".$record["firstName"]." ".$record["middleName"];
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
			$row["cancel"] = "'".Yii::app()->createUrl('/_teacher/_admin/users/cancelRole')."', 'content_manager', '".$record["id"]."', '6'";
			array_push($return['data'], $row);
		}

		return json_encode($return);
	}
	public function counter($id){

		$sql22 = 'SELECT COUNT(*) as counter FROM lectures WHERE idModule='.$id;
		$course22 = Yii::app()->db->createCommand($sql22)->queryAll();
		return $course22;
	}
	public static function listOfCourses(){



		//$sql2= new Lecture;
		//$course = $sql2->statisticalName();
		//$tmp =Module::model()->getTitle();
		//$model = Module::model()->findByPk([1,2,3]);//получили один модуль полностью
		//$model2 = new Module;
		//$tmp = $model2->lectures;
		//$tmp= $model->lectures;



		//$r =$tmp->lectures;
		//$dddd = new Module;
		$sql = 'select * from module'; //рабочий лекции
		$course = Yii::app()->db->createCommand($sql)->queryAll();//рабочий лекции
		//SELECT COUNT(*) FROM `table` WHERE `field_1`='value_1'
		$return = array('data' => array());

		//$temporary2=14;
			//$sql22 = 'SELECT COUNT(*) as counter FROM lectures ';
			//$course22 = Yii::app()->db->createCommand($sql22)->queryAll();
		//$num_rows = mysql_num_rows($course22);

		foreach($course as $record){
			$row = array();
			$row["name"]["title"] = $record['title_ua'];
			$row["lesson"]["title"] = $record["lesson_count"];
			$tmp=UserContentManager::counter($record['module_ID']);
			$row["video"]=$tmp;
			$row["test"]=2;
			$row["part"]=3;
			array_push($return['data'], $row);
		}

		return json_encode($return);
//		$sql = 'select * from user as u, user_consultant as uc where u.id = uc.id_user';
//		$consultants = Yii::app()->db->createCommand($sql)->queryAll();
//		$return = array('data' => array());
//
//		foreach ($consultants as $record) {
//			$row = array();
//			$row["name"]["title"] = $record["secondName"]." ".$record["firstName"]." ".$record["middleName"];
//			$row["email"]["title"] = $record["email"];
//			$row["email"]["url"] = $row["name"]["url"] = Yii::app()->createUrl('/_teacher/_content_manager/contentManager/showTeacher',
//				array('id' => $record['id']));
//			$row["register"] = ($record["start_date"] > 0) ? date("d.m.Y",  strtotime($record["start_date"])):"невідомо";
//			$row["cancelDate"] = ($record["end_date"]) ? date("d.m.Y", strtotime($record["end_date"])) : "";
//			$row["cancel"] = "'".Yii::app()->createUrl('/_teacher/_admin/users/cancelRole')."'".", 'consultant', '".$record["id"]."', '9'";
//			array_push($return['data'], $row);
//		}
//
//		return json_encode($return);
	}

}
