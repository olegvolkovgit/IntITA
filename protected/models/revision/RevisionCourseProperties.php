<?php

/**
 * This is the model class for table "vc_course_properties".
 *
 * The followings are the available columns in table 'vc_course_properties':
 * @property integer $id
 * @property string $alias
 * @property string $language
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 * @property integer $level
 * @property string $start
 * @property integer $status_online
 * @property integer $status_offline
 * @property string $for_whom_ua
 * @property string $what_you_learn_ua
 * @property string $what_you_get_ua
 * @property string $for_whom_ru
 * @property string $what_you_learn_ru
 * @property string $what_you_get_ru
 * @property string $for_whom_en
 * @property string $what_you_learn_en
 * @property string $what_you_get_en
 * @property string $course_img
 * @property integer $rating
 * @property integer $cancelled
 * @property integer $course_number
 * @property string $start_date
 * @property integer $id_user_created
 * @property string $update_date
 * @property integer $id_user_updated
 *
 * @property integer $id_state
 * @property integer $id_user
 * @property string $change_date
 *
 * The followings are the available model relations:
 * @property Course[] $courses
 */
class RevisionCourseProperties extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_course_properties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alias, language, title_ua, level, status_online, status_offline', 'required'),
			array('level, status_online, status_offline, rating, cancelled, course_number, id_user_created, id_user_updated, id_user, id_state', 'numerical', 'integerOnly'=>true),
			array('alias', 'length', 'max'=>20),
			array('language', 'length', 'max'=>6),
			array('title_ua, title_ru, title_en', 'length', 'max'=>100),
			array('title_ua', 'match', 'pattern' => "/".Yii::app()->params['titleUAPattern']."+$/u", 'message' => Yii::t('error', '0416')),
			array('title_ru', 'match', 'pattern' => "/".Yii::app()->params['titleRUPattern']."+$/u", 'message' => Yii::t('error', '0416')),
			array('title_en', 'match', 'pattern' => "/".Yii::app()->params['titleENPattern']."+$/u", 'message' => Yii::t('error', '0416')),
			array('course_img', 'length', 'max'=>255),
			array('course_img', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true, 'on'=>'saveFile'),
			array('start, for_whom_ua, what_you_learn_ua, what_you_get_ua, for_whom_ru, what_you_learn_ru, what_you_get_ru, for_whom_en, what_you_learn_en, what_you_get_en, start_date, update_date, change_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, alias, language, title_ua, title_ru, title_en, level, start, , status_online, status_offline' .
                'for_whom_ua, what_you_learn_ua, what_you_get_ua, for_whom_ru, what_you_learn_ru, ' .
                'what_you_get_ru, for_whom_en, what_you_learn_en, what_you_get_en, course_img, rating, cancelled, ' .
                'course_number, start_date, id_user_created, update_date, id_user_updated, id_state, id_user, change_date', 'safe', 'on'=>'search'),
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
			'courses' => array(self::HAS_MANY, 'Course', 'id_properties'),
			'revision' => array(self::HAS_ONE, 'RevisionCourse', ['id_properties'=>'id']),
			'level0' => array(self::BELONGS_TO, 'Level', 'level'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'alias' => 'Alias',
			'language' => 'Language',
			'title_ua' => 'Title Ua',
			'title_ru' => 'Title Ru',
			'title_en' => 'Title En',
			'level' => 'Level',
			'start' => 'Start',
            'status_online' => 'Онлайн-статус',
            'status_offline' => 'Офлайн-статус',
			'for_whom_ua' => 'For Whom Ua',
			'what_you_learn_ua' => 'What You Learn Ua',
			'what_you_get_ua' => 'What You Get Ua',
			'for_whom_ru' => 'For Whom Ru',
			'what_you_learn_ru' => 'What You Learn Ru',
			'what_you_get_ru' => 'What You Get Ru',
			'for_whom_en' => 'For Whom En',
			'what_you_learn_en' => 'What You Learn En',
			'what_you_get_en' => 'What You Get En',
			'course_img' => 'Course Img',
			'rating' => 'Rating',
			'cancelled' => 'Cancelled',
			'course_number' => 'Course Number',
			'start_date' => 'Start Date',
			'id_user_created' => 'Id User Created',
			'update_date' => 'Update Date',
			'id_user_updated' => 'Id User Updated',
            'id_state' => 'Id State',
            'id_user' => 'Id User',
            'change_date' => 'change_date'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('title_ua',$this->title_ua,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('start',$this->start,true);
        $criteria->compare('status_online', $this->status_online, true);
        $criteria->compare('status_offline', $this->status_offline, true);
		$criteria->compare('for_whom_ua',$this->for_whom_ua,true);
		$criteria->compare('what_you_learn_ua',$this->what_you_learn_ua,true);
		$criteria->compare('what_you_get_ua',$this->what_you_get_ua,true);
		$criteria->compare('for_whom_ru',$this->for_whom_ru,true);
		$criteria->compare('what_you_learn_ru',$this->what_you_learn_ru,true);
		$criteria->compare('what_you_get_ru',$this->what_you_get_ru,true);
		$criteria->compare('for_whom_en',$this->for_whom_en,true);
		$criteria->compare('what_you_learn_en',$this->what_you_learn_en,true);
		$criteria->compare('what_you_get_en',$this->what_you_get_en,true);
		$criteria->compare('course_img',$this->course_img,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('cancelled',$this->cancelled);
		$criteria->compare('course_number',$this->course_number);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('id_user_created',$this->id_user_created);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('id_user_updated',$this->id_user_updated);
        $criteria->compare('id_user',$this->id_user);
        $criteria->compare('id_state',$this->id_state);
        $criteria->compare('change_date',$this->change_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionCourseProperties the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Clone properties
	 * @param $user
	 * @return RevisionCourseProperties
	 */
	public function cloneProperties($user) {
		$newProperties = new RevisionCourseProperties();
		$newProperties->title_ua = $this->title_ua;
		$newProperties->title_ru = $this->title_ru;
		$newProperties->title_en = $this->title_en;
		$newProperties->course_img = $this->course_img;
		$newProperties->alias = $this->alias;
		$newProperties->language = $this->language;
		$newProperties->for_whom_ua = $this->for_whom_ua;
		$newProperties->what_you_learn_ua = $this->what_you_learn_ua;
		$newProperties->what_you_get_ua = $this->what_you_get_ua;
		$newProperties->for_whom_ru = $this->for_whom_ru;
		$newProperties->what_you_learn_ru = $this->what_you_learn_ru;
		$newProperties->what_you_get_ru = $this->what_you_get_ru;
		$newProperties->for_whom_en = $this->for_whom_en;
		$newProperties->what_you_learn_en = $this->what_you_learn_en;
		$newProperties->what_you_get_en = $this->what_you_get_en;
		$newProperties->level = $this->level;
		$newProperties->course_number = $this->course_number;
		$newProperties->cancelled = $this->cancelled;
		$newProperties->status_online = $this->status_online;
        $newProperties->status_offline = $this->status_offline;

		$newProperties->start_date = new CDbExpression('NOW()');
		$newProperties->id_user_created = $user->getId();

		$newProperties->id_state = RevisionState::EditableState;
		$newProperties->id_user = $user->getId();
		$newProperties->change_date = new CDbExpression('NOW()');

		$newProperties->saveCheck();

		return $newProperties;
	}

	/**
	 * Sets update date and id user.
	 * @param $user - current user model
	 */
	public function setUpdateDate($user) {
		$this->update_date = new CDbExpression('NOW()');
		$this->id_user_updated = $user->getId();
		$this->saveCheck();
	}

	public function updateRevisionCourseLogo($imageName,$tmpName,$id)
	{
		$this->setScenario('saveFile');
		$ext = substr(strrchr($imageName, '.'), 1);
		$imageName = uniqid() . '.' . $ext;

		copy($tmpName, Yii::getpathOfAlias('webroot') . "/images/course/" . $imageName);

		RevisionCourseProperties::model()->updateByPk($id, array('course_img' => $imageName));

		return true;
	}
	
	/**
	 * Save properties model with error checking
	 * @throws RevisionException
	 */
	public function saveCheck() {
		if(!$this->save()) {
			throw new RevisionException($this->getValidationErrors(), '400');
		}
	}

	public function getValidationErrors() {
		$errors=[];
		foreach($this->getErrors() as $key=>$attribute){
			foreach($attribute as $error){
				array_push($errors,$key.': '.$error);
			}
		}
		return implode(", ", $errors);
	}
}
