<?php

/**
 * This is the model class for table "offline_students".
 *
 * The followings are the available columns in table 'offline_students'
 * @property integer $id_user
 * @property string $start_date
 * @property string $end_date
 * @property string $graduate_date
 * @property integer $id_subgroup
 *
 * The followings are the available model relations:
 * @property OfflineSubgroups $subgroupName
 * @property StudentReg $user
 * @property TrainerStudent $trainer
 * @property OfflineGroups $group
 */
class OfflineStudents extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'offline_students';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, start_date, id_subgroup', 'required'),
			// The following rule is used by search().
			array('id_user, start_date, end_date, graduate_date, id_subgroup', 'safe', 'on'=>'search'),
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
			'subgroupName' => array(self::HAS_ONE, 'OfflineSubgroups', ['id'=>'id_subgroup']),
			'user' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
			'trainer' => array(self::HAS_ONE, 'TrainerStudent', ['student'=>'id_user'], 'on' => 'trainer.end_time IS NULL'),
			'group' => array(self::HAS_ONE, 'OfflineGroups', array('group'=>'id'), 'through' => 'subgroupName'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'ID студента',
			'start_date' => 'Включення в групу',
			'end_date' => 'Виключення з підгрупи',
			'graduate_date' => 'Дата випуску',
			'id_subgroup' => 'ID підгрупи',
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
		$criteria->compare('graduate_date',$this->graduate_date);
		$criteria->compare('id_subgroup',$this->id_subgroup,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OfflineStudents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function primaryKey(){
		return array('id_user','id_subgroup');
	}

	public static function studentData($id){
		$student = OfflineStudents::model()->findByAttributes(array('id_user'=>$id));
		$data=array();
		$data["id_user"] = $student->id_user;
		$data["startDate"] = $student->start_date;
		$data["endDate"] = $student->end_date;
		$data["graduateDate"] = $student->graduate_date;
		$data["idSubgroup"] = $student->id_subgroup;
		$data["groupName"] = $student->group->name;
		$data["subgroupName"] = $student->subgroupName->name;

		return $data;
	}
}