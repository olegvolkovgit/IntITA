<?php

/**
 * This is the model class for table "vc_module_properties".
 *
 * The followings are the available columns in table 'vc_module_properties':
 * @property integer $id
 * @property string $module_img
 * @property string $alias
 * @property string $language
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 * @property integer $module_price
 * @property string $for_whom
 * @property string $what_you_learn
 * @property string $what_you_get
 * @property integer $level
 * @property integer $hours_in_day
 * @property integer $days_in_week
 * @property integer $rating
 * @property integer $module_number
 * @property integer $cancelled
 * @property integer $status
 * @property integer $price_offline
 * @property string $start_date
 * @property integer $id_user_created
 * @property string $update_date
 * @property integer $id_user_updated
 *
 * @property integer $id_state
 * @property integer $id_user
 * @property string $change_date
 *
 *
 * The followings are the available model relations:
 * @property Module[] $modules
 */
class RevisionModuleProperties extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_module_properties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, , start_date', 'required'),
			array('language, title_ua, level', 'required', 'message' => 'Поле не може бути пустим'),
			array('alias', 'match', 'pattern' => "/^((?:[\d]*[^\d]+[\d]*)+$)/u", 'message' => 'Псевдонім не може містити тільки цифри'),
			array('alias', 'match', 'pattern' => "/^[a-zA-Z0-9_]+$/u", 'message' => 'Допустимі символи: латинські літери, цифри та знак "_"'),
			array('module_number, cancelled, level, module_price', 'numerical', 'integerOnly' => true, 'min'=>0, 'message' => Yii::t('module', '0413'),'tooSmall' => 'Значення має бути цілим, невід\'ємним'),
			array('hours_in_day', 'numerical', 'integerOnly' => true, 'min'=>0,'max'=>24, 'message' => Yii::t('module', '0413'),'tooSmall' => 'Значення має бути цілим, невід\'ємним', 'tooBig'=>'Занадто велике число'),
			array('days_in_week', 'numerical', 'integerOnly' => true, 'min'=>0,'max'=>7, 'message' => Yii::t('module', '0413'),'tooSmall' => 'Значення має бути цілим, невід\'ємним', 'tooBig'=>'Занадто велике число'),
			array('module_price', 'length', 'max' => 10, 'message' => 'Ціна модуля занадто велика.'),
			array('alias', 'length', 'max' => 30, 'message' => 'Довжина псевдоніма занадто велика.'),
			array('language', 'length', 'max' => 6),
			array('title_ua', 'match', 'pattern' => "/".Yii::app()->params['titleUAPattern']."+$/u", 'message' => Yii::t('error', '0416')),
			array('title_ru', 'match', 'pattern' => "/".Yii::app()->params['titleRUPattern']."+$/u", 'message' => Yii::t('error', '0416')),
			array('title_en', 'match', 'pattern' => "/".Yii::app()->params['titleENPattern']."+$/u", 'message' => Yii::t('error', '0416')),
			array('module_img, title_ua, title_ru, title_en', 'length', 'max' => 255),
			array('module_img', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true, 'on'=>'saveFile'),
			array('id_user_created, id_user_updated, id_state, id_user', 'numerical', 'integerOnly'=>true),
			array('for_whom, what_you_learn, what_you_get, days_in_week, hours_in_day, level,days_in_week, hours_in_day, level, rating, start_date, update_date, change_date', 'safe'),
			array('title_ua, title_ru, title_en, level,hours_in_day, days_in_week', 'required', 'message' => Yii::t('module', '0412'), 'on' => 'canedit'),
			array('hours_in_day, days_in_week', 'numerical', 'integerOnly' => true, 'min' => 1, "tooSmall" => Yii::t('module', '0413'), 'message' => Yii::t('module', '0413'), 'on' => 'canedit'),
			array('module_price', 'numerical', 'integerOnly' => true, 'min' => 0, "tooSmall" => Yii::t('module', '0413'), 'message' => Yii::t('module', '0413'), 'on' => 'canedit'),
			// The following rule is used by search().
			array('module_ID, title_ua, title_ru, title_en, alias, language, module_price, for_whom,
            what_you_learn, what_you_get, module_img,
			days_in_week, hours_in_day, level, module_number, cancelled, id_state, id_user_created, id_user, start_date, update_date, id_user_updated, change_date', 'safe', 'on' => 'search'),
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
			'revision' => array(self::HAS_ONE, 'RevisionModule', ['id_properties'=>'id']),
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
			'title_ua' => 'Назва українською',
			'title_ru' => 'Назва російською',
			'title_en' => 'Назва англійською',
			'alias' => 'Псевдонім',
			'language' => 'Мова',
			'module_price' => 'Ціна модуля базова, USD',
			'for_whom' => 'Для кого',
			'what_you_learn' => 'Що ти вивчиш',
			'what_you_get' => 'Що ти отримаєш',
			'module_img' => 'Фото',
			'module_number' => 'Номер модуля',
			'cancelled' => 'Видалений',
			'status' => 'Статус',
			'hours_in_day' => 'Годин в день (рекомендований графік занять)',
			'days_in_week' => 'Днів у тиждень (рекомендований графік занять)',
			'level' => 'Рівень',
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
		$criteria->compare('title_ua', $this->title_ua, true);
		$criteria->compare('title_ru', $this->title_ru, true);
		$criteria->compare('title_en', $this->title_en, true);
		$criteria->compare('alias', $this->alias, true);
		$criteria->compare('language', $this->language, true);
		$criteria->compare('module_price', $this->module_price, true);
		$criteria->compare('for_whom', $this->for_whom, true);
		$criteria->compare('what_you_learn', $this->what_you_learn, true);
		$criteria->compare('what_you_get', $this->what_you_get, true);
		$criteria->compare('module_img', $this->module_img, true);
		$criteria->compare('days_in_week', $this->days_in_week, true);
		$criteria->compare('hours_in_day', $this->hours_in_day, true);
		$criteria->compare('level', $this->level, true);
		$criteria->compare('rating', $this->rating, true);
		$criteria->compare('module_number', $this->module_number, true);
		$criteria->compare('cancelled', $this->cancelled, true);
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
	 * @return RevisionLectureProperties the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Initialize module properties
	 * @param $titleUa
	 * @param $titleEn
	 * @param $titleRu
	 * @param $user
	 * @throws RevisionLecturePropertiesException
	 */
	public function initialize($titleUa, $titleEn, $titleRu, $user){
		//todo refactor default values
		$this->module_img = "module.png";
//		$this->module_price = 0;
		$this->level = 1;
		$this->language = 'ua';
		$this->hours_in_day = 3;
		$this->days_in_week = 3;
		$this->cancelled = 0;
		$this->status = 0;
		$this->title_ua = $titleUa;
		$this->title_ru = $titleRu;
		$this->title_en = $titleEn;
		$this->start_date = new CDbExpression('NOW()');
		$this->id_user_created = $user->getId();

        $this->id_state = RevisionState::EditableState;
        $this->id_user = $user->getId();
        $this->change_date = new CDbExpression('NOW()');

        $this->saveCheck();
	}

	/**
	 * Clone properties
	 * @param $user
	 * @return RevisionModuleProperties
	 */
	public function cloneProperties($user) {
		$newProperties = new RevisionModuleProperties();
		$newProperties->module_img = $this->module_img;
		$newProperties->alias = $this->alias;
		$newProperties->language = $this->language;
		$newProperties->module_price = $this->module_price;
		$newProperties->title_ua = $this->title_ua;
		$newProperties->title_ru = $this->title_ru;
		$newProperties->title_en = $this->title_en;
		$newProperties->for_whom = $this->for_whom;
		$newProperties->what_you_learn = $this->what_you_learn;
		$newProperties->what_you_get = $this->what_you_get;
		$newProperties->level = $this->level;
		$newProperties->hours_in_day = $this->hours_in_day;
		$newProperties->days_in_week = $this->days_in_week;
		$newProperties->rating = $this->rating;
		$newProperties->module_number = $this->module_number;
		$newProperties->cancelled = $this->cancelled;
		$newProperties->status = $this->status;
		$newProperties->price_offline = $this->price_offline;

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
	 * @throws RevisionModuleException
	 */
	public function setUpdateDate($user) {
		$this->update_date = new CDbExpression('NOW()');
		$this->id_user_updated = $user->getId();
		$this->saveCheck();
	}

	/**
	 * Save properties model with error checking
	 * @throws RevisionModuleException
	 */
	public function saveCheck() {
		if(!$this->save()) {
			throw new RevisionModuleException('400',$this->getValidationErrors());
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

	public function updateRevisionModuleLogo($imageName,$tmpName,$id)
	{
		$this->setScenario('saveFile');
		$ext = substr(strrchr($imageName, '.'), 1);
		$imageName = uniqid() . '.' . $ext;
		copy($tmpName, Yii::getpathOfAlias('webroot') . "/images/module/" . $imageName);

		RevisionModuleProperties::model()->updateByPk($id, array('module_img' => $imageName));

		return true;
	}
}
