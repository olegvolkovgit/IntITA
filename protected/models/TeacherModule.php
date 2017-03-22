<?php

/**
 * This is the model class for table "teacher_module".
 *
 * The followings are the available columns in table 'teacher_module':
 * @property integer $id
 * @property integer $idTeacher
 * @property integer $idModule
 * @property string $start_time
 * @property string $end_time
 * @property string $assigned_by
 * @property string $cancelled_by
 *
 * The followings are the available model relations:
 * @property Module $idModule0
 * @property Teacher $idTeacher0
 */
class TeacherModule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTeacher, idModule', 'required'),
			array('idTeacher, idModule', 'numerical', 'integerOnly'=>true),
			array('id, idTeacher, idModule, start_time, end_time, assigned_by, cancelled_by', 'safe'),
			// The following rule is used by search().
			array('id, idTeacher, idModule, start_time, end_time', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'StudentReg', ['idTeacher'=>'id']),
			'assigned_by_user' => array(self::BELONGS_TO, 'StudentReg', ['assigned_by'=>'id']),
			'cancelled_by_user' => array(self::BELONGS_TO, 'StudentReg',['cancelled_by'=>'id']),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTeacher' => 'Id Teacher',
			'idModule' => 'Id Module',
            'start_time' => 'Start time',
            'end_time' => 'End time',
			'assigned_by' => 'Assigned by',
			'cancelled_by' => 'Cancelled by',
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
		$criteria->compare('idTeacher',$this->idTeacher);
		$criteria->compare('idModule',$this->idModule);
        $criteria->compare('start_time',$this->start_time);
        $criteria->compare('end_time',$this->end_time);
		$criteria->compare('assigned_by',$this->assigned_by);
		$criteria->compare('cancelled_by',$this->cancelled_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherModule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function addTeacherAccess($teacher, $module){
        $model = new TeacherModule();
        if (!TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
            ':teacher' => $teacher,
            ':module' => $module,
        ))){
            $model->idTeacher = $teacher;
            $model->idModule = $module;
            if ($model->validate()){
                $model->save();
            }
        }
    }

    public static function cancelTeacherAccess($teacher, $module){
        if (TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
            ':teacher' => $teacher,
            ':module' => $module,
        ))){
            TeacherModule::model()->deleteAllByAttributes(array('idTeacher' => $teacher, 'idModule' => $module));
        }
    }

	public static function listByModule($module){
		$sql = 'select u.id, u.firstName, u.middleName, u.secondName, u.email, tm.start_time, tm.end_time from teacher_module tm
		LEFT JOIN user u on u.id=tm.idTeacher WHERE tm.idModule='.$module;

		return Yii::app()->db->createCommand($sql)->queryAll();
	}

	public static function authorsList(){
		$sql = 'select u.id, u.email, u.firstName, u.secondName, u.middleName from user as u
                left join teacher_module as tm on tm.idTeacher = u.id
                where tm.idTeacher IS NOT NULL group by u.id';
		$authors = Yii::app()->db->createCommand($sql)->queryAll();
		$return = array('data' => array());

		foreach ($authors as $record) {
			$row = array();
			$row["name"]["title"] = $record["secondName"]." ".$record["firstName"]." ".$record["middleName"];
			$row["email"]["title"] = $record["email"];
			$row["email"]["url"] = $row["name"]["url"] = Yii::app()->createAbsoluteUrl("/_teacher/_admin/user/index",
				array('id' => $record["id"]));
			array_push($return['data'], $row);
		}

		return json_encode($return);
	}
}
