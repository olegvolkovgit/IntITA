<?php

/**
 * This is the model class for table "vc_plain_task".
 *
 * The followings are the available columns in table 'vc_plain_task':
 * @property integer $id
 * @property integer $id_lecture_element
 * @property integer $id_test
 * @property integer $uid
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property RevisionLectureElement $idLectureElement
 */
class RevisionPlainTask extends RevisionQuiz
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_plain_task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lecture_element, uid', 'required'),
			array('id, id_lecture_element, id_test, uid, updated', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lecture_element, id_test, uid, updated', 'safe', 'on'=>'search'),
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
			'lectureElement' => array(self::BELONGS_TO, 'RevisionLectureElement', 'id_lecture_element'),
		);
	}

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_lecture_element' => 'Id Lecture Element',
			'id_test' => 'Id Test',
            'uid' => 'UID',
            'updated' => 'Updated'
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
		$criteria->compare('id_lecture_element',$this->id_lecture_element);
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionPlainTask the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function saveCheck($runValidation=true, $attributes=null) {
        if(!$this->save($runValidation,$attributes)) {
            throw new RevisionPlainTaskException(implode("; ", $this->getErrors()));
        }
    }

    public static function createTest($idLectureElement, $idModule, $idTest=null, $uid=null) {
        $newPlainTest = new RevisionPlainTask();
        $newPlainTest->id_lecture_element = $idLectureElement;
        $newPlainTest->id_test = $idTest;
        $newPlainTest->uid = $uid ? $uid: RevisionQuizFactory::getQuizId($idModule);
        $newPlainTest->saveCheck();

        return $newPlainTest;
    }

    public function cloneTest($idLectureElement) {
        $newPlainTest = new RevisionPlainTask();
        $newPlainTest->id_lecture_element = $idLectureElement;
        $newPlainTest->uid = $this->uid;
        $newPlainTest->updated = $this->updated == 1 ? 1 : 0;
        $newPlainTest->id_test = $this->id_test;
        $newPlainTest->saveCheck();

        return $newPlainTest;
    }

    public function editTest() {
        $this->saveCheck();
        return;
    }

    public function deleteTest() {
        return;
    }

    public function saveToRegularDB($lectureElementId, $idUserCreated) {
        $plainTask = PlainTask::model()->findByAttributes(['uid' => $this->uid]);
        if($plainTask == null) {
            $newPlainTask = new PlainTask();
            $newPlainTask->block_element = $lectureElementId;
            $newPlainTask->author = $idUserCreated;
            $newPlainTask->uid = $this->uid;
            $newPlainTask->save();
            return $newPlainTask;
        } else {
            $plainTask->block_element = $lectureElementId;
            $plainTask->save();
        }
        return false;
    }
}