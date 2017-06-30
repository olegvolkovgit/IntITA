<?php

/**
 * This is the model class for table "rating_user_course".
 *
 * The followings are the available columns in table 'rating_user_course':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_course
 * @property integer $course_revision
 * @property double $rating
 * @property integer $course_done
 * @property datetime $date_done
 * @property datetime $start_course
 *
 * The followings are the available model relations:
 * @property Course $idCourse
 * @property VcCourse $courseRevision
 * @property User $idUser
 */
class RatingUserCourse extends CActiveRecord implements IUserRating
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rating_user_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_course, course_revision, rating', 'required'),
			array('id_user, id_course, course_revision, course_done', 'numerical', 'integerOnly'=>true),
			array('rating', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_course, course_revision, rating, course_done, date_done, start_course', 'safe', 'on'=>'search'),
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
			'idCourse' => array(self::BELONGS_TO, 'Course', 'id_course'),
			'courseRevision' => array(self::BELONGS_TO, 'VcCourse', 'course_revision'),
			'idUser' => array(self::BELONGS_TO, 'User', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_course' => 'Id Course',
			'course_revision' => 'Course Revision',
			'rating' => 'Rating',
			'course_done' => 'Course Done',
            'start_course' => 'Course Start',
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
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_course',$this->id_course);
		$criteria->compare('course_revision',$this->course_revision);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('course_done',$this->course_done);
        $criteria->compare('start_course',$this->start_course);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RatingUserCourse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function rateUser($user)
    {
      $rate = 0;
      $modules = RevisionCourseModule::model()->findAll('id_course_revision=:idRevision',[':idRevision'=>$this->course_revision]);
      foreach ($modules as $module){
          $rateModule = RatingUserModule::model()->find('id_module=:module AND id_user=:user',[':module'=>$module->id_module,':user'=>$user]);
          if($rateModule && $rateModule->module_done){
             $rate += $rateModule->rating;
          }
          else{
              return false;
          }
      }

      $this->rating = $rate/count($modules);
      $this->course_done = (int)true;
      $this->date_done = new CDbExpression('NOW()');
      $this->save();
      return true;
    }

    public static function updateCourseProgress($user, $idCourse)
    {
        $course=Course::model()->findByPk($idCourse);
        if($course->checkPaidAccess($user)){
            //create course progress if there are no record
            $course->createRatingUserCourseRecord($user);
            $courseProgress=RatingUserCourse::model()->find('id_course=:idCourse AND id_user=:user AND course_done = 0',
                [':idCourse'=>$idCourse,':user'=>$user]);
            if ($courseProgress) {
                $courseProgress->rateUser($user);
            }
        }
    }

}
