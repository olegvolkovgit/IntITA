<?php

/**
 * This is the model class for table "vc_tests_answers".
 *
 * The followings are the available columns in table 'vc_tests_answers':
 * @property integer $id
 * @property integer $id_test
 * @property string $answer
 * @property integer $is_valid
 *
 * The followings are the available model relations:
 * @property Tests $test
 */
class RevisionTestsAnswers extends CActiveRecord
{
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_tests_answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_test, answer, is_valid', 'required'),
			array('id_test, is_valid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_test, answer, is_valid', 'safe', 'on'=>'search'),
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
			'test' => array(self::BELONGS_TO, 'Tests', 'id_test'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_test' => 'Id Test',
			'answer' => 'Answer',
			'is_valid' => 'Is Valid',
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
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('is_valid',$this->is_valid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionTestsAnswers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function saveCheck($runValidation=true,$attributes=null) {
        if(!$this->save($runValidation,$attributes)) {
            throw new RevisionTestsAnswersException(implode("; ", $this->getErrors()));
        }
    }

    public static function createAnswer($idTest, $answer) {
        $newTestAnswer = new RevisionTestsAnswers();
        $newTestAnswer->id_test = $idTest;
        $newTestAnswer->answer = $answer['answer'];
        $newTestAnswer->is_valid = $answer['is_valid'];
        $newTestAnswer->saveCheck();
        return $newTestAnswer;
    }

    public function cloneTestAnswer($idTest) {
        $newTestAnswer = new RevisionTestsAnswers();
        $newTestAnswer->id_test = $idTest;
        $newTestAnswer->answer = $this->answer;
        $newTestAnswer->is_valid = $this->is_valid;
        $newTestAnswer->saveCheck();
        return $newTestAnswer;
    }

}
