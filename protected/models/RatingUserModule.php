<?php

/**
 * This is the model class for table "rating_user_module".
 *
 * The followings are the available columns in table 'rating_user_module':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_module
 * @property integer $module_revision
 * @property double $rating
 * @property integer $module_done
 *
 * The followings are the available model relations:
 * @property Module $idModule
 * @property VcModule $moduleRevision
 * @property User $idUser
 */
class RatingUserModule extends CActiveRecord implements IUserRating
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rating_user_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_module, module_revision, rating', 'required'),
			array('id_user, id_module, module_revision, module_done', 'numerical', 'integerOnly'=>true),
			array('rating', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_module, module_revision, rating, module_done', 'safe', 'on'=>'search'),
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
			'idModule' => array(self::BELONGS_TO, 'Module', 'id_module'),
			'moduleRevision' => array(self::BELONGS_TO, 'VcModule', 'module_revision'),
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
			'id_module' => 'Id Module',
			'module_revision' => 'Module Revision',
			'rating' => 'Rating',
			'module_done' => 'Module Done',
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
		$criteria->compare('id_module',$this->id_module);
		$criteria->compare('module_revision',$this->module_revision);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('module_done',$this->module_done);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RatingUserModule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function rateUser($user)
    {
        $rate = 0;
        $lectures = RevisionModuleLecture::model()->with(['lecture'])->findAll('id_module_revision=:moduleRevision',[':moduleRevision'=>$this->module_revision]);
        foreach ($lectures as $lecture){
            $lectureRate = $this->checkLectureRate($lecture->lecture, $user);
            if ($lectureRate){
                $rate += $lectureRate;
            }
            else return false;
        }
        $this->rating = $rate/count($lectures);
        $this->module_done = true;
        $this->save();
        return true;
    }

    private function checkLectureRate($lecture, $user){

        $tasks = TasksInLectures::model()->findAll('id_lecture=:lecture AND id_state=:revisionState',[':lecture'=>$lecture->id_lecture, ':revisionState'=>RevisionState::ReleasedState]);
        foreach ($tasks as $task){

            switch ($task->id_type){
                case LectureElement::TEST;
                    $tests = TestsMarks::model()->with(['idLecture'])->findAll('id_lecture=:lecture AND id_user=:user',[':lecture'=>$lecture->id_lecture, ':user'=>$user]);
                    if (!$tests)
                        return 0;
                break;
                case LectureElement::SKIP_TASK;
                    $tests = SkipTaskMarks::model()->with(['idLecture'])->findAll('id_lecture=:lecture  AND user=:user',[':lecture'=>$lecture->id_lecture, ':user'=>$user]);
                    if (!$tests)
                        return 0;
                break;
                case LectureElement::PLAIN_TASK;
                    $tests = PlainTaskMarks::model()->with(['idLecture'])->findAll('id_lecture=:lecture  AND id_user=:user',[':lecture'=>$lecture->id_lecture, ':user'=>$user]);
                    if (!$tests)
                        return 0;
                break;
                case LectureElement::TASK;
                    $tests = TaskMarks::model()->with(['idLecture'])->findAll('id_lecture=:lecture',[':lecture'=>$lecture->id_lecture]);
                    if (!$tests)
                        return 0;
                    break;
             }
        }

	    $lectureRate = 0;

        foreach ($tests as $test){
            $lectureRate +=$test->mark;
        }
	    return $lectureRate/count($tests);
    }
}
