<?php

/**
 * This is the model class for table "vc_tests".
 *
 * The followings are the available columns in table 'vc_tests':
 * @property integer $id
 * @property integer $id_lecture_element
 * @property string $title
 *
 * The followings are the available model relations:
 * @property RevisionLectureElement $lectureElement
 * @property RevisionTestsAnswers[] $testsAnswers
 */
class RevisionTests extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_tests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lecture_element', 'required'),
			array('id_lecture_element', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lecture_element, title', 'safe', 'on'=>'search'),
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
			'lectureElement' => array(self::BELONGS_TO, 'LectureElement', 'id_lecture_element'),
			'testsAnswers' => array(self::HAS_MANY, 'TestsAnswers', 'id_test'),
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
			'title' => 'Title',
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
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionTests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function saveCheck($runValidation=true, $attributes=null) {
        if(!$this->save($runValidation,$attributes)) {
            throw new RevisionTestsException(implode("; ", $this->getErrors()));
        }
    }

    public static function createTest($idLectureElement, $title, $answers) {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $newTest = new RevisionTests();
            $newTest->id_lecture_element = $idLectureElement;
            $newTest->title = $title;
            $newTest->saveCheck();

            foreach ($answers as $answer) {
                $newAnswer = RevisionTestsAnswers::createAnswer($newTest->id, $answer);
            }

            $transaction->commit();
            return $newTest;
        } catch (Exception $e) {
            $transaction->rollback();
            throw ($e);
        }
    }

    public function cloneTest($idLectureElement) {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $newTest = new RevisionTests();
            $newTest->id_lecture_element = $idLectureElement;
            $newTest->title = $this->title;
            $newTest->saveCheck();

            foreach ($this->testsAnswers as $answer) {
                $answer->cloneTestAnswer($newTest->id);
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw ($e);
        }
    }
}
