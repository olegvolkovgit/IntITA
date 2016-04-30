<?php

/**
 * This is the model class for table "vc_skip_task".
 *
 * The followings are the available columns in table 'vc_skip_task':
 * @property integer $id
 * @property integer $condition
 * @property integer $question
 * @property string $source
 * @property integer $id_test
 *
 * The followings are the available model relations:
 * @property RevisionLectureElement $conditionLectureElement
 * @property RevisionLectureElement $questionLectureElement
 * @property RevisionSkipTaskAnswers[] $answers
 */
class RevisionSkipTask extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_skip_task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('condition, question, source', 'required'),
			array('condition, question, id_test', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, condition, question, source, id_test', 'safe', 'on'=>'search'),
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
			'conditionLectureElement' => array(self::BELONGS_TO, 'RevisionLectureElement', 'condition'),
			'questionLectureElement' => array(self::BELONGS_TO, 'RevisionLectureElement', 'question'),
			'answers' => array(self::HAS_MANY, 'RevisionSkipTaskAnswers', 'id_task'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'condition' => 'Condition',
			'question' => 'Question',
			'source' => 'Source',
			'id_test' => 'Id Test',
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
		$criteria->compare('condition',$this->condition);
		$criteria->compare('question',$this->question);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('id_test',$this->id_test);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionSkipTask the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function saveCheck($runValidation=true, $attributes=null) {
        if(!$this->save($runValidation,$attributes)) {
            throw new RevisionSkipTaskException(implode("; ", $this->getErrors()));
        }
    }

    public static function createTest($idLectureElement, $assignment, $language, $table, $idTest=null) {
    }

    public function cloneTest($idLectureElement) {
    }

    public function editTest($assignment, $language, $table) {
    }

    public function deleteTest() {
    }

    public function saveToRegularDB($lectureElementId, $idUserCreated) {
    }

}
