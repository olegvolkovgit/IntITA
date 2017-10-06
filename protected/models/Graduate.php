<?php

/**
 * This is the model class for table "graduate".
 *
 * The followings are the available columns in table 'graduate':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $avatar
 * @property datetime $graduate_date
 * @property string $position
 * @property string $work_place
 * @property string $work_site
 * @property string $courses_page
 * @property string $history
 * @property integer $id_user
 * @property integer $published
 * @property string $recall
 * @property string $first_name_en
 * @property string $last_name_en
 * @property string $first_name_ru
 * @property string $last_name_ru
 *
 * @property Course $course
 * The followings are the available model relations:
 * @property RatingUserCourse $courses[]
 * @property RatingUserModule $modules[]
 * @property StudentReg $user
 */
class Graduate extends CActiveRecord
{
    use loadFromRequest;
    use withToArray;
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
            array('graduate_date', 'required', 'message'=>"Поле обов'язкове для заповнення"),
            array('first_name_ru, last_name_ru','match', 'pattern'=>'/^([а-яА-ЯёЁ\s])+$/u', 'message' => 'Недопустимі символи!'),
            array('position, work_place, work_site, history', 'length', 'max'=>255),

			array('first_name_en, last_name_en', 'length', 'max'=>50),
            // The following rule is used by search().
			array('id, position, work_place, work_site, history, recall, first_name_en, last_name_en, first_name_ru, last_name_ru, id_user, published, graduate_date', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'StudentReg', ['id_user'=>'id']),
            'courses' => array(self::HAS_MANY, 'RatingUserCourse', ['id_user'=>'id_user'], 'on' => 'course_done=1', 'order' => 'date_done asc'),
            'modules' => array(self::HAS_MANY, 'RatingUserModule', ['id_user'=>'id_user'], 'on' => 'module_done=1 and paid_module=true', 'order' => 'end_module asc'),
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
            'published' => 'Опубліковано',
            'id_user' => 'Користувач',
            'graduate_date' => 'Дата випуску',
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
        $criteria->compare('id_user',$this->id_user);
        $criteria->compare('published',$this->published);
        $criteria->compare('graduate_date',$this->graduate_date);

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

    public static function getGraduateBySelector($selector, $string)
    {
        $criteria = new CDbCriteria();
        $criteria->with = ['user'];

        if( strlen( $string ) > 0 ){
            $criteria->addSearchCondition('firstName', $string, true, "OR", "LIKE");
            $criteria->addSearchCondition('secondName', $string, true, "OR", "LIKE");
            $criteria->addSearchCondition('work_place', $string, true, "OR", "LIKE");
            $criteria->addSearchCondition('position', $string, true, "OR", "LIKE");
        }

        if ($selector == 'az'){
            if(isset(Yii::app()->session['lg']) && Yii::app()->session['lg'] == 'en') {
                $criteria->order = 'last_name_en COLLATE utf8_unicode_ci ASC';
            }else{
                $criteria->order = 'user.secondName COLLATE utf8_unicode_ci ASC';
            }
        }
        if ($selector == 'date') $criteria->order = 'graduate_date DESC';
//        if ($selector == 'rating') $criteria->order = 'rate.rating DESC';
        $criteria->addCondition('published=1');
        $dataProvider = new CActiveDataProvider( 'Graduate', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>20,
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

    public function getAverageRating(){
	    $count=count($this->courses)+count($this->modules);
	    $sum=0;
	    foreach ($this->courses as $course){
	        $sum=$sum+$course->rating;
        }
        foreach ($this->modules as $module){
            $sum=$sum+$module->rating;
        }

        return round($sum/$count,2);
    }

    public static function create($user,$graduateDate){
        if(!Graduate::model()->findByAttributes(array('id_user'=>$user))){
            $model=new Graduate();
            $model->published=1;
            $model->id_user=$user;
            $model->graduate_date=$graduateDate;
            $model->save();
            if (!(Yii::app() instanceof CConsoleApplication)){
                $model->notifyAssignGraduate($model->user);
            }
        }
    }

    public function notifyAssignGraduate(StudentReg $user){
        $user->notify('_assignGraduate', array($user->id), 'Ти став випускником');
    }

    public function graduateName(){
        if(isset(Yii::app()->session['lg']) && Yii::app()->session['lg'] == 'en'){
            $name = trim($this->first_name_en.' '.$this->last_name_en);
        }else if(isset(Yii::app()->session['lg']) && Yii::app()->session['lg'] == 'ru'){
            $name = trim($this->first_name_ru.' '.$this->last_name_ru);
        }else{
            $name=trim($this->user['firstName'].' '.$this->user['secondName']);
        }
        echo $name? $name : $this->user['email'];
    }
}
