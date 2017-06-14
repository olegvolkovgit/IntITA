<?php

/**
 * This is the model class for table "tests_marks".
 *
 * The followings are the available columns in table 'tests_marks':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_test
 * @property integer $mark
 * @property integer $quiz_uid
 */
class TestsMarks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tests_marks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_test, mark, quiz_uid', 'required'),
			array('id, id_user, id_test, mark, quiz_uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_test, mark, quiz_uid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{

		return array(
		    'test' => [self::BELONGS_TO,'Tests',['id_test'=>'id']],
            'lectureElement'=>[self::BELONGS_TO,'LectureElement', ['block_element' => 'id_block'],'through' => 'test',],
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
			'id_test' => 'Id Test',
			'mark' => 'Mark',
			'quiz_uid' => 'quiz_uid',
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
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('mark',$this->mark);
		$criteria->compare('quiz_uid',$this->quiz_uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestsMarks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function addTestMark($user, $idTest, $mark){

        $test = Tests::model()->findByPk($idTest);

        $model = new TestsMarks();

        $model->id_user = $user;
        $model->id_test = $test->id;
        $model->quiz_uid = $test->uid;
        $model->mark = $mark;

        $model->save(true);
    }

    public static function isTestDone($user, $idTest){
        return TestsMarks::model()->exists('id_user =:user and quiz_uid =:test and mark = 1',
            array(':user' => $user, ':test' => $idTest));
    }
	public static function testTime($user, $idTest){
		if(TestsMarks::model()->exists('id_user =:user and quiz_uid =:test and mark = 1',
			array(':user' => $user, ':test' => $idTest))){
			return TestsMarks::model()->findByAttributes(array('id_user' => $user,'quiz_uid' => $idTest,'mark' => 1))->time;
		}else return false;
	}
}
