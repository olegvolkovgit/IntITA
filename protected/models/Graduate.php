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
 * @property integer $rate_id
 * @property string $recall
 * @property string $first_name_en
 * @property string $last_name_en
 * @property string $first_name_ru
 * @property string $last_name_ru
 *
 * @property Course $course
 */
class Graduate extends CActiveRecord
{
    use loadFromRequest;
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
            array('position, work_place, work_site, history, recall, first_name_en, last_name_en', 'required', 'message'=>"Поле обов'язкове для заповнення"),
            array('first_name_ru, last_name_ru','match', 'pattern'=>'/^([а-яА-ЯёЁ\s])+$/u', 'message' => 'Недопустимі символи!'),
            array('position, work_place, work_site, history', 'length', 'max'=>255),

			array('first_name_en, last_name_en', 'length', 'max'=>50),
            // The following rule is used by search().
			array('id, position, work_place, work_site, history, recall, first_name_en, last_name_en, first_name_ru, last_name_ru, rate_id', 'safe', 'on'=>'search'),
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
            'rate' => array(self::BELONGS_TO, 'RatingUserCourse', ['rate_id'=>'id']),
            'user' => array(self::BELONGS_TO, 'StudentReg', ['id_user'=>'id'], 'through'=>'rate'),
            'course' => array(self::BELONGS_TO, 'Course', ['id_course'=>'course_ID'], 'through'=>'rate'),
		);
	}

	public function scopes()
	{
		return array(
			'orderUkr'=>array(
				'order'=>'first_name COLLATE utf8_unicode_ci',
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'position' => Yii::t('graduate','0756'),
			'work_place' => Yii::t('graduate','0757'),
			'work_site' => Yii::t('graduate','0758'),
			'history' => Yii::t('graduate','0760'),
			'recall' => Yii::t('graduate','0762'),
			'first_name_en' => Yii::t('graduate','0763'),
			'last_name_en' => Yii::t('graduate','0764'),
            'first_name_ru' => 'Ім\'я російською',
            'last_name_ru' => 'Прізвище російською',
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
		$criteria->compare('position',$this->position,true);
		$criteria->compare('work_place',$this->work_place,true);
		$criteria->compare('work_site',$this->work_site,true);
		$criteria->compare('history',$this->history,true);
		$criteria->compare('recall',$this->recall,true);
		$criteria->compare('first_name_en',$this->first_name_en,true);
		$criteria->compare('last_name_en',$this->last_name_en,true);
        $criteria->compare('first_name_en',$this->first_name_ru,true);
        $criteria->compare('last_name_en',$this->last_name_ru,true);
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
        $criteria = new CDbCriteria;
        $criteria->alias = 'graduate';
        $criteria->with = ['rate','user'];
        if ($selector == 'az'){
			if(isset(Yii::app()->session['lg']) && Yii::app()->session['lg'] == 'en') {
				$criteria->order = 'last_name_en COLLATE utf8_unicode_ci ASC';
			}else{
				$criteria->order = 'user.firstName COLLATE utf8_unicode_ci ASC';
			}
		}
        if ($selector == 'date') $criteria->order = 'rate.date_done DESC';
        if ($selector == 'rating') $criteria->order = 'rate.rating DESC';

        $dataProvider=new CActiveDataProvider('Graduate', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));

        return $dataProvider;
    }

    public function name(){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en'  && $this->last_name_en != 'не указано' && $this->last_name_en != ''){
                return $this->first_name_en."&nbsp;".$this->last_name_en;
            }
            if(Yii::app()->session['lg'] == 'ru'  && $this->last_name_ru != 'не указано' && $this->last_name_ru != ''){
                return $this->first_name_ru."&nbsp;".$this->last_name_ru;
            }
        }
        return $this->first_name."&nbsp;".$this->last_name;
    }

	public static function graduatesList(){
        $graduates = Graduate::model()->findAll();
        $return = array('data' => array());

        foreach ($graduates as $record) {
            $row = array();
            $row["name"]["title"] = $record->first_name." ".$record->last_name;
			$row["name"]["header"] = addslashes($record->first_name." ".$record->last_name);
            $row["avatar"] = StaticFilesHelper::createPath('image', 'graduates', $record->avatar);
            $row["position"] = CHtml::encode($record->position);
            $row["workPlace"] = CHtml::encode($record->work_place);
            $row["recall"] = mb_substr(CHtml::encode($record->recall),0,500,'UTF-8')."...";
            $row["name"]["link"] = "'".Yii::app()->createUrl("/_teacher/_admin/graduate/view", array("id"=>$record->id))."'";
            $row["linkEdit"] = "'".Yii::app()->createUrl('/_teacher/_admin/graduate/update', array('id'=>$record->id))."'";
            array_push($return['data'], $row);
        }

        return json_encode($return);
	}


}
