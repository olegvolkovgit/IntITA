<?php

/**
 * This is the model class for table "graduate".
 *
 * The followings are the available columns in table 'graduate':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property string $graduate_date
 * @property string $position
 * @property string $work_place
 * @property string $work_site
 * @property string $courses_page
 * @property string $history
 * @property integer $rate
 * @property string $recall
 * @property string $first_name_en
 * @property string $last_name_en
 */
class Graduate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'graduate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('first_name', 'required', 'message'=>'Введіть ім\'я випускника.'),
			array('avatar', 'file','types'=>'jpg, gif, png','maxSize' => 1024*1024*5, 'allowEmpty' => true, 'tooLarge'=>Yii::t('error','0302')),
            array('last_name', 'required', 'message'=>'Введіть прізвище випускника.'),
			array('rate', 'numerical', 'integerOnly'=>true, 'message'=>'Рейтинг повинен бути числовим значенням.'),
			array('first_name, last_name, avatar, position, work_place, work_site, history', 'length', 'max'=>255),
			array('courses_page, first_name_en, last_name_en', 'length', 'max'=>50),
			array('graduate_date', 'date', 'format' => 'yyyy-MM-dd','message'=>'Введіть дату в форматі РРРР-ММ-ДД'),
			array('graduate_date, recall', 'safe'),
			// The following rule is used by search().
			array('id, first_name, last_name, avatar, graduate_date, position, work_place, work_site, courses_page, history, rate, recall, first_name_en, last_name_en', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'first_name' => "І'мя",
			'last_name' => 'Прізвище',
			'avatar' => 'Фото',
			'graduate_date' => 'Дата випуску',
			'position' => 'Посада',
			'work_place' => 'Місце роботи',
			'work_site' => 'Сайт',
			'courses_page' => 'Закінчив(ла) курс',
			'history' => 'Історія',
			'rate' => 'Рейтинг',
			'recall' => 'Відгук',
			'first_name_en' => "І'мя англійською",
			'last_name_en' => 'Прізвище англійською',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('graduate_date',$this->graduate_date,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('work_place',$this->work_place,true);
		$criteria->compare('work_site',$this->work_site,true);
		$criteria->compare('courses_page',$this->courses_page,true);
		$criteria->compare('history',$this->history,true);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('recall',$this->recall,true);
		$criteria->compare('first_name_en',$this->first_name_en,true);
		$criteria->compare('last_name_en',$this->last_name_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Graduate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getGraduateBySelector($selector)
    {
        $criteria= new CDbCriteria;
        $criteria->alias = 'graduate';
        if ($selector == 'az') $criteria->order = 'last_name COLLATE utf8_unicode_ci ASC';
        if ($selector == 'date') $criteria->order = 'graduate_date DESC';
        if ($selector == 'rating') $criteria->order = 'rate DESC';

        $dataProvider=new CActiveDataProvider('Graduate', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));

        return $dataProvider;
    }
}
