<?php

/**
 * This is the model class for table "user_student".
 *
 * The followings are the available columns in table 'user_student':
 * @property integer $id_user
 * @property string $start_date
 * @property string $end_date
 * @property integer $assigned_by
 * @property integer $cancelled_by
 * @property integer $id_organization
 *
 * The followings are the available model relations:
 * @property StudentReg $idUser
 */
class UserStudent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_student';
	}
    public function getRoleName()
    {
        return 'Студент';
    }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, assigned_by, id_organization', 'required'),
			array('id_user', 'numerical', 'integerOnly'=>true),
			array('end_date', 'safe'),
			// The following rule is used by search().
			array('id_user, start_date, end_date, assigned_by, cancelled_by, id_organization', 'safe', 'on'=>'search'),
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
            'assigned_by_user' => array(self::BELONGS_TO, 'StudentReg', ['assigned_by'=>'id']),
            'cancelled_by_user' => array(self::BELONGS_TO, 'StudentReg',['cancelled_by'=>'id']),
            'activeMembers' => array(self::BELONGS_TO, 'StudentReg', 'id_user','condition'=>'end_date IS NULL AND activeMembers.cancelled=0'),
            'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
            'studentTrainer' => array(self::HAS_ONE, 'TrainerStudent', array('student'=>'id_user','id_organization'=>'id_organization'),
                'on' => 'end_time IS NULL'),
		);
	}

	public function primaryKey()
	{
		return array('id_user', 'start_date', 'id_organization');
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
            'assigned_by' => 'Assigned by',
            'cancelled_by' => 'Cancelled by',
            'id_organization' => 'Id organization',
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
        $criteria->compare('assigned_by',$this->assigned_by,true);
        $criteria->compare('cancelled_by',$this->cancelled_by,true);
        $criteria->compare('id_organization',$this->id_organization,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserStudent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function addStudent(StudentReg $user){
		$model = new UserStudent();
        $model->id_user = $user->id;

        return $model->save();
	}

	public static function studentHasSubgroup($id){
		$model = OfflineStudents::model()->findByAttributes(array('id_user'=>$id,'end_date'=>null));
		if($model) return true;
		else return false;
	}

	public static function studentByQuery($query){
		$criteria = new CDbCriteria();
		$criteria->select = "id, secondName, firstName, middleName, email, avatar";
		$criteria->alias = "s";
		$criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
		$criteria->join = 'LEFT JOIN user_student us ON us.id_user = s.id';
		$criteria->addCondition('us.id_user IS NOT NULL and us.end_date is NULL');

		$data = StudentReg::model()->findAll($criteria);

		$result = [];
		foreach ($data as $key=>$model) {
			$result["results"][$key]["id"] = $model->id;
			$result["results"][$key]["name"] = trim($model->secondName . " " . $model->firstName . " " . $model->middleName);
			$result["results"][$key]["email"] = $model->email;
			$result["results"][$key]["url"] = $model->avatarPath();
		}
		return json_encode($result);
	}

	public static function studentWithoutTrainerByQuery($query){
		$criteria = new CDbCriteria();
		$criteria->select = "id, secondName, firstName, middleName, email, avatar";
		$criteria->alias = "s";
		$criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
		$criteria->join = 'LEFT JOIN user_student us ON us.id_user = s.id';
		$criteria->join .= ' LEFT JOIN trainer_student ts ON ts.student = us.id_user';
		$criteria->addCondition('us.id_user IS NOT NULL and us.end_date is NULL 
		and us.id_user NOT IN (SELECT student FROM trainer_student WHERE id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.')');
		$criteria->group = 's.id';

		$data = StudentReg::model()->findAll($criteria);

		$result = [];
		foreach ($data as $key=>$model) {
			$result["results"][$key]["id"] = $model->id;
			$result["results"][$key]["name"] = trim($model->secondName . " " . $model->firstName . " " . $model->middleName);
			$result["results"][$key]["fullName"] = trim($model->secondName . " " . $model->firstName . " " . $model->middleName." ".$model->email);
			$result["results"][$key]["email"] = $model->email;
			$result["results"][$key]["url"] = $model->avatarPath();
		}
		return json_encode($result);
	}
}
