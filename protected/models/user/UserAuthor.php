<?php

/**
 * This is the model class for table "user_author".
 *
 * The followings are the available columns in table 'user_author':
 * @property integer $id_user
 * @property string $start_date
 * @property string $end_date
 * @property integer $assigned_by
 * @property integer $cancelled_by
 * @property integer $id_organization
 */
class UserAuthor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_author';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, assigned_by, id_organization', 'required'),
			array('end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, start_date, end_date, assigned_by, cancelled_by, id_organization', 'safe', 'on'=>'search'),
		);
	}
    public function getRoleName()
    {
        return 'Автор контенту';
    }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'StudentReg', ['id_user'=>'id']),
			'authorActive' => array(self::BELONGS_TO, 'StudentReg', ['id_user'=>'id'],'condition'=>'end_date IS NULL', 'group'=>'id_user'),
			'assigned_by_user' => array(self::BELONGS_TO, 'StudentReg', ['assigned_by'=>'id']),
			'cancelled_by_user' => array(self::BELONGS_TO, 'StudentReg',['cancelled_by'=>'id']),
			'activeMembers' => array(self::BELONGS_TO, 'StudentReg', ['id_user'=>'id'],'condition'=>'end_date IS NULL AND activeMembers.cancelled=0'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('assigned_by',$this->assigned_by,true);
		$criteria->compare('cancelled_by',$this->cancelled_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAuthor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function findAll($condition='',$params=array())
	{
		Yii::trace(get_class($this).'.findAll()','system.db.ar.CActiveRecord');
		$criteria=$this->getCommandBuilder()->createCriteria($condition,$params);
		$criteria->mergeWith(array(
				'group'=>'id_user',
		));

		return parent::findAll($criteria);
	}

	public static function authorsList($query, $organization){
		$criteria = new CDbCriteria();
		$criteria->select = "id, secondName, firstName, middleName, email, avatar";
		$criteria->alias = "s";
		$criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id=s.id';
        $criteria->join .= ' LEFT JOIN teacher_organization tco on tco.id_user=s.id';
        $criteria->join .= ' LEFT JOIN user_author ua ON ua.id_user = s.id';
		$criteria->addCondition('t.user_id IS NOT NULL and tco.id_user IS NOT NULL and tco.end_date IS NULL and tco.id_organization='.$organization.' 
		and ua.id_user IS NOT NULL and ua.end_date is NULL and ua.id_organization='.$organization);
        $criteria->group = 's.id';

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
}
