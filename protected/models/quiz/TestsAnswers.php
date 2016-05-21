<?php

/**
 * This is the model class for table "tests_answers".
 *
 * The followings are the available columns in table 'tests_answers':
 * @property integer $id
 * @property integer $id_test
 * @property string $answer
 * @property integer $is_valid
 * @property integer $quiz_uid
 *
 * The followings are the available model relations:
 * @property Tests $idTest
 */
class TestsAnswers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tests_answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quiz_uid', 'required'),
			//array('id_test, answer, is_valid', 'required'),
			array('id, id_test, is_valid, quiz_uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_test, answer, is_valid, quiz_uid', 'safe', 'on'=>'search'),
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
			'idTest' => array(self::BELONGS_TO, 'Tests', 'id_test'),
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
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('is_valid',$this->is_valid);
		$criteria->compare('quiz_uid',$this->quiz_uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestsAnswers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function addOptions($test, $options){
		$count = count($options);

		for($i = 0; $i < $count; $i++){
			$model = new TestsAnswers();

			$model->id_test = $test;
			$model->answer = $options[$i]["option"];
			$model->is_valid = ($options[$i]["isTrue"])?1:0;

			$model->save(false);
		}
	}
    public static function editOptions($test, $options){
        $count = count($options);
		$model=new TestsAnswers();
		/*������� ������ ��� �������� ������� ����� ������������ �� ����������*/
		$criteria = new CDbCriteria();
		$criteria->alias='test_answers';
		$criteria->addCondition('id_test='.$test);
		$criteria->order = 'id ASC';
		$sortedAnswers = TestsAnswers::model()->findAll($criteria);
		/*������� �������� �� ����� ����*/
		$answersCount=count($sortedAnswers);
		/*���� �������� �� ����� ���� ����� �� ���� ��� ����, �� �������� ���� ������ � ���������� ���*/
		if($answersCount<=$count){
			$j=0;
			foreach($sortedAnswers as $answers){
				$model->updateByPk($answers->id, array('answer' => $options[$j]["option"]));
				$model->updateByPk($answers->id, array('is_valid' => ($options[$j]["isTrue"])?1:0));
				$j++;
			}
			for($i=$answersCount;$i<($count);$i++){

				$newModel = new TestsAnswers();
				$newModel->id_test = $test;
				$newModel->answer = $options[$i]["option"];
				$newModel->is_valid = ($options[$i]["isTrue"])?1:0;

				$newModel->save(false);
			}

		}
		/*���� �������� �� ����� ���� ����� �� ����, �� �������� ���� ������ � ��������� ����*/
		elseif ($answersCount>$count){
			$k=0;
			foreach($sortedAnswers as $answers){
				if($k>=$count){
					$model->deleteByPk($answers->id);
					$k++;
				}else{
					$model->updateByPk($answers->id, array('answer' => $options[$k]["option"]));
					$model->updateByPk($answers->id, array('is_valid' => ($options[$k]["isTrue"])?1:0));
					$k++;
				}
			}
		}
    }

    public static function checkTestAnswer($test, $userAnswers){

		if(!is_array($userAnswers)){
			$userAns=array($userAnswers);
		}else $userAns=$userAnswers;

        $criteria = new CDbCriteria();
        $criteria->select = 'id';
        $criteria->addCondition('id_test = :id_test and is_valid = 1');
        $criteria->params = array(':id_test' => $test);
        $criteria->toArray();
        $validAnswersRecords = TestsAnswers::model()->findAll($criteria);

        $count = count($validAnswersRecords);
        $validAnswers = [];
        for ($i = 0; $i < $count; $i++){
            $validAnswers[$i] = $validAnswersRecords[$i]["id"];
        }

        return TestsAnswers::checkValidAnswers($validAnswers, $userAns);
    }

    public static function checkValidAnswers($validAnswers, $userAnswers){

        if(count(array_diff($userAnswers, $validAnswers)) == 0 && count(array_diff($validAnswers, $userAnswers)) == 0){
			return true;
        } else {
           return false;
        }
    }

    public static function getOptionsNum($block){

        $test = Tests::getTestId($block);
        $criteria = new CDbCriteria();
        $criteria->select = 'answer';
        $criteria->condition = 'id_test = :id_test';
        $criteria->params = array(':id_test'=>$test);
        $optionsNum = TestsAnswers::model()->count($criteria);

        return $optionsNum;
    }

    public static function getOptions($block){

        $test = Tests::getTestId($block);
        $criteria = new CDbCriteria();
        $criteria->select = 'answer';
        $criteria->condition = 'id_test = '.$test;

        $options = TestsAnswers::model()->findAll($criteria);
        return $options;
    }

    public static function getTestValidCKE($block){
        $answers=[];
        $test = TestsAnswers::model()->findAllByAttributes(array('id_test' => Tests::getTestId($block)));
        foreach($test as $answer){
            if ($answer->is_valid==0)
                array_push($answers, 'false');
            elseif ($answer->is_valid==1)
                array_push($answers, 'true');
        }
        return $answers;
    }

    public static function getTestValid($block){
        $answers=[];
        $test = TestsAnswers::model()->findAllByAttributes(array('id_test' => Tests::getTestId($block)));
        foreach($test as $answer){
            if ($answer->is_valid==0)
                array_push($answers, '');
            elseif ($answer->is_valid==1)
                array_push($answers, 'checked');
        }
        return $answers;
    }

    public static function getTestAnswers($block){
        $answers=[];
        $test = TestsAnswers::model()->findAllByAttributes(array('id_test' => Tests::getTestId($block)));
        foreach($test as $answer){
            array_push($answers, $answer->answer);
        }
        return $answers;
    }

    public static function getAnswerKey($block){
        $answerKey =[];
        $test = TestsAnswers::model()->findAllByAttributes(array('id_test' => Tests::getTestId($block)));
        foreach($test as $answerid){
            array_push($answerKey, $answerid->id);
        }
        return $answerKey;
    }
}
