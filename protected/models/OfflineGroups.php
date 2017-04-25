<?php

/**
 * This is the model class for table "offline_groups".
 *
 * The followings are the available columns in table 'offline_groups':
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $specialization
 * @property integer $city
 * @property integer $id_user_created
 * @property integer $chat_author_id
 * @property integer $id_organization
 *
 * Relations
 * @property OfflineSubgroups[] $subGroups
 * @property OfflineStudents[] $offlineStudents
 * @property StudentReg[] $students
 *
 * Behaviours
 * @property VisitorAccessBehavior $access
 */

class OfflineGroups extends CActiveRecord
{
	private $errorMessage = "";
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'offline_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_date, specialization, city, id_user_created, chat_author_id, id_organization', 'required'),
			array('name', 'length', 'max'=>128),
			array('name', 'unique', 'caseSensitive' => false, 'message' => 'Група з такою назвою вже існує'),
			// The following rule is used by search().
			array('id, name, start_date, specialization, city, id_user_created, chat_author_id, id_organization', 'safe', 'on'=>'search'),
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
			'specializationName' => array(self::HAS_ONE, 'SpecializationsGroup', ['id'=>'specialization']),
			'cityName' => array(self::HAS_ONE, 'AddressCity', ['id'=>'city']),
			'userCreator' => array(self::BELONGS_TO, 'StudentReg', 'id_user_created'),
			'userChatAuthor' => array(self::BELONGS_TO, 'StudentReg', 'chat_author_id'),
            'subGroups' => [self::HAS_MANY, 'OfflineSubgroups', 'group'],
            'offlineStudents' => [self::HAS_MANY, 'OfflineStudents', ['id' => 'id_subgroup'], 'through' =>'subGroups'],
            'students' => [self::HAS_MANY, 'StudentReg', ['id_user' => 'id'], 'on' => 'offlineStudents.end_date IS NULL or offlineStudents.end_date > NOW()', 'through' =>'offlineStudents'],
			'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
		);
	}

	protected function beforeValidate()
	{
		if(!$this->isNewRecord && $this->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id){
			throw new \application\components\Exceptions\IntItaException(403, 'Ваші права не дозволяють змінювати групу в межах даної організації');
			return false;
		}

		return parent::beforeValidate();
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Назва',
			'start_date' => 'Дата створення',
			'specialization' => 'Спеціалізація',
			'city' => 'Місто',
			'id_user_created' => 'Ід автора групи',
			'chat_author_id' => 'Ід автора чату групи',
			'id_organization' => 'Id організації',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('specialization',$this->specialization,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('id_user_created',$this->id_user_created,true);
		$criteria->compare('chat_author_id',$this->chat_author_id,true);
		$criteria->compare('id_organization',$this->id_organization,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OfflineGroups the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors() {
        return [
            'access' => [
                'class' => 'GroupAccessBehavior'
            ]
        ];
    }

	public function primaryKey(){
		return 'id';
	}

	public static function groupsByQuery($query)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "id, name";
		$criteria->alias = "g";
		$criteria->addSearchCondition('LOWER(name)', mb_strtolower($query,'UTF-8'), true, "OR", "LIKE");
		$criteria->addCondition('g.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
		$data = OfflineGroups::model()->findAll($criteria);
		$result = array();
		foreach ($data as $key => $model) {
			$result["results"][$key]["id"] = $model->id;
			$result["results"][$key]["name"] = $model->name;
		}
		return json_encode($result);
	}

	public function getValidationErrors() {
		$errors=[];
		foreach($this->getErrors() as $key=>$attribute){
			foreach($attribute as $error){
				array_push($errors,$error);
			}
		}
		array_push($errors,$this->errorMessage);
		return implode(", ", $errors);
	}

	public function availableCoursesList($organization=null)
	{
		$condition='NOW() BETWEEN ga.start_date AND ga.end_date AND group_id='.$this->id;
		if($organization) $condition=$condition.' and c.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
		$courses = Yii::app()->db->createCommand()
			->select('c.cancelled, c.course_ID id, c.language lang, c.title_ua, c.title_ru, c.title_en,
			 l.title_ua level_ua, l.title_ru level_ru, l.title_en level_en, org.name')
			->from('acc_course_service acs')
			->join('group_access_to_content ga', 'ga.service_id=acs.service_id')
			->join('course c', 'c.course_ID=acs.course_id')
			->join('level l', 'l.id=c.level')
            ->join('organization org', 'org.id=c.id_organization')
			->where($condition)
			->queryAll();
		return $courses;
	}

	public function availableModulesList($organization=null)
	{
		$condition='NOW() BETWEEN ga.start_date AND ga.end_date AND group_id='.$this->id;
		if($organization) $condition=$condition.' and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id;
		$modules = Yii::app()->db->createCommand()
			->select('m.cancelled, m.module_ID id, m.language lang, m.title_ua, m.title_ru, m.title_en,
			l.title_ua level_ua, l.title_ru level_ru, l.title_en level_en, org.name')
			->from('acc_module_service ams')
			->join('group_access_to_content ga', 'ga.service_id=ams.service_id')
			->join('module m', 'm.module_ID=ams.module_id')
			->join('level l', 'l.id=m.level')
            ->join('organization org', 'org.id=m.id_organization')
			->where($condition)
			->queryAll();
		return $modules;
	}

	public function checkOrganization(){
		if($this->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id){
			$this->errorMessage='Організація групи не співпадає з застосованою організацією';
			return false;
		}
		return true;
	}
}