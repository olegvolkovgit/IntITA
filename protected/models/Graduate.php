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
 * @property string $courses
 * @property string $courses_page
 * @property string $history
 * @property integer $rate
 * @property string $recall
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
			array('rate', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, avatar, position, work_place, work_site, courses, courses_page, history', 'length', 'max'=>255),
			array('graduate_date, recall', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, avatar, graduate_date, position, work_place, work_site, courses, courses_page, history, rate, recall', 'safe', 'on'=>'search'),
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
			'first_name' => "Ім'я",
			'last_name' => 'Прізвище',
			'avatar' => 'Фото',
			'graduate_date' => 'Рік випуску',
			'position' => 'Посада',
			'work_place' => 'Місце роботи',
			'work_site' => 'Сайт',
			'courses' => 'Пройдені курси',
			'courses_page' => 'Сторінка курсів',
			'history' => 'Історія (не відображається)',
			'rate' => 'Рейтинг',
			'recall' => 'Відгук',
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
		$criteria->compare('courses',$this->courses,true);
		$criteria->compare('courses_page',$this->courses_page,true);
		$criteria->compare('history',$this->history,true);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('recall',$this->recall,true);

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

    protected function beforeSave()
    {
        if (($this->scenario == "update") && empty($this->avatar['tmp_name']['avatar']))
        {
            $this->avatar = $this->oldAvatar;
        } else if(($this->scenario=="update") && (!empty($this->avatar['tmp_name']['avatar']))){
            $src=Yii::getPathOfAlias('webroot')."/images/graduates/".$this->oldAvatar;
            if (is_file($src))
                unlink($src);
        }
        if (($this->scenario=="insert" || $this->scenario=="update")&& !empty($this->avatar['tmp_name']['avatar']))
        {
            if(!copy($this->avatar['tmp_name']['avatar'],Yii::getPathOfAlias('webroot')."/images/graduates/".$this->avatar['name']['avatar']))
                throw new CHttpException(500);
        }
        return true;
    }

    protected function beforeDelete()
    {
        $src=Yii::getPathOfAlias('webroot')."/images/teachers/".$this->foto_url;
        if (is_file($src))
            unlink($src);
        return true;
    }
}
