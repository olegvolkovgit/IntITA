<?php

/**
 * This is the model class for table "teacher".
 *
 * The followings are the available columns in table 'teacher':
 * @property integer $teacher_id
 * @property string $lang
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $foto_url
 * @property string $subjects
 * @property string $profile_text_first
 * @property string $profile_text_short
 * @property string $profile_text_last
 * @property string $readMoreLink
 * @property string $email
 * @property string $tel
 * @property string $skype
 * @property string $title
 * @property string $linkName
 * @property string $smallImage
 * @property integer $rate_knowledge
 * @property integer $rate_efficiency
 * @property integer $rate_relations
 * @property string $sections
 * @property integer $user_id
 * @property string $courses
 */
class Teacher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lang, first_name, middle_name, last_name, foto_url, subjects, profile_text_first, profile_text_short, profile_text_last, readMoreLink, email, tel, skype, title, linkName, smallImage, rate_knowledge, rate_efficiency, rate_relations, sections, user_id', 'required'),
			array('rate_knowledge, rate_efficiency, rate_relations, user_id', 'numerical', 'integerOnly'=>true),
			array('lang', 'length', 'max'=>6),
			array('first_name, middle_name, last_name', 'length', 'max'=>35),
			array('foto_url, subjects, tel', 'length', 'max'=>100),
			array('readMoreLink, smallImage', 'length', 'max'=>255),
			array('email, skype, title, linkName', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('teacher_id, lang, first_name, middle_name, last_name, foto_url, subjects, profile_text_first, profile_text_short, profile_text_last, readMoreLink, email, tel, skype, title, linkName, smallImage, rate_knowledge, rate_efficiency, rate_relations, sections, user_id, courses', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'teacher_id' => 'Teacher',
			'lang' => 'Lang',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'foto_url' => 'Foto Url',
			'subjects' => 'Subjects',
			'profile_text_first' => 'Profile Text First',
			'profile_text_short' => 'Profile Text Short',
			'profile_text_last' => 'Profile Text Last',
			'readMoreLink' => 'Read More Link',
			'email' => 'Email',
			'tel' => 'Tel',
			'skype' => 'Skype',
			'title' => 'Title',
			'linkName' => 'Link Name',
			'smallImage' => 'Small Image',
			'rate_knowledge' => 'Rate Knowledge',
			'rate_efficiency' => 'Rate Efficiency',
			'rate_relations' => 'Rate Relations',
			'sections' => 'Sections',
			'user_id' => 'User',
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

		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('foto_url',$this->foto_url,true);
		$criteria->compare('subjects',$this->subjects,true);
		$criteria->compare('profile_text_first',$this->profile_text_first,true);
		$criteria->compare('profile_text_short',$this->profile_text_short,true);
		$criteria->compare('profile_text_last',$this->profile_text_last,true);
		$criteria->compare('readMoreLink',$this->readMoreLink,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('linkName',$this->linkName,true);
		$criteria->compare('smallImage',$this->smallImage,true);
		$criteria->compare('rate_knowledge',$this->rate_knowledge);
		$criteria->compare('rate_efficiency',$this->rate_efficiency);
		$criteria->compare('rate_relations',$this->rate_relations);
		$criteria->compare('sections',$this->sections,true);
		$criteria->compare('user_id',$this->user_id);
        $criteria->compare('courses',$this->courses);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => 20,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Teacher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function updateFirstText($id, $firstText){
        return Teacher::model()->updateByPk($id, array('profile_text_first' => $firstText));
    }

    public static function updateSecondText($id, $secondText){
        return Teacher::model()->updateByPk($id, array('profile_text_last' => $secondText));
    }
}
