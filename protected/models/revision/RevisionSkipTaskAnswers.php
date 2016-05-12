<?php

/**
 * This is the model class for table "vc_skip_task_answers".
 *
 * The followings are the available columns in table 'vc_skip_task_answers':
 * @property integer $id
 * @property integer $id_task
 * @property string $answer
 * @property integer $answer_order
 * @property integer $case_in_sensitive
 * @property integer $uid
 *
 * The followings are the available model relations:
 * @property RevisionSkipTaskSkipTask $task
 */
class RevisionSkipTaskAnswers extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vc_skip_task_answers';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_task, answer, answer_order, uid', 'required'),
            array('id_task, answer_order, case_in_sensitive, uid', 'numerical', 'integerOnly' => true),
            array('answer', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_task, answer, answer_order, case_in_sensitive, uid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'task' => array(self::BELONGS_TO, 'RevisionSkipTask', 'id_task'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_task' => 'Id Task',
            'answer' => 'Answer',
            'answer_order' => 'Answer Order',
            'case_in_sensitive' => 'Case In Sensitive',
            'uid' => 'UID',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_task', $this->id_task);
        $criteria->compare('answer', $this->answer, true);
        $criteria->compare('answer_order', $this->answer_order);
        $criteria->compare('case_in_sensitive', $this->case_in_sensitive);
        $criteria->compare('uid', $this->uid);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RevisionSkipTaskAnswers the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function saveCheck($runValidation = true, $attributes = null) {
        if (!$this->save($runValidation, $attributes)) {
            throw new RevisionSkipTaskAnswersException(implode("; ", $this->getErrors()));
        }
    }

    public static function createAnswer($testId, $answer, $caseInsensitive, $order) {
        $newAnswer = new RevisionSkipTaskAnswers();
        $newAnswer->id_task = $testId;
        $newAnswer->answer = $answer;
        $newAnswer->case_in_sensitive = $caseInsensitive;
        $newAnswer->answer_order = $order;

        $newAnswer->saveCheck();

        return $newAnswer;
    }

    public function cloneAnswer($idTest) {
        $newAnswer = new RevisionSkipTaskAnswers();
        $newAnswer->id_task = $idTest;
        $newAnswer->answer = $this->answer;
        $newAnswer->case_in_sensitive = $this->case_in_sensitive;
        $newAnswer->answer_order = $this->answer_order;

        $newAnswer->saveCheck();

        return $newAnswer;
    }

    public function edit($answer, $caseInsensitive, $order) {
        $this->answer = $answer;
        $this->case_in_sensitive = $caseInsensitive;
        $this->answer_order = $order;
        $this->saveCheck();
    }

    public function saveToRegularDB($idTask) {
        $newSkipTaskAnswer = new SkipTaskAnswers();
        $newSkipTaskAnswer->setAttributes(['answer' => $this->answer,
            'id_task' => $idTask,
            'answer_order' => $this->answer_order,
            'case_in_sensitive' => $this->case_in_sensitive]);
        $newSkipTaskAnswer->save();
        return $newSkipTaskAnswer;
    }

    public static function checkSkipAnswer($quizId,$answers)
    {
        $isDone = true;
        $skipTaskAnswers = RevisionSkipTask::model()->findByAttributes(array('condition' => $quizId))->answers;
        usort($skipTaskAnswers, function($a, $b)
        {
            return strcmp($a->answer_order, $b->answer_order);
        });

        for($i = 0;$i < count($skipTaskAnswers);$i++)
        {
            $answer = $answers[$i][0];
            $taskAnswer = $skipTaskAnswers[$i]->answer;
            if($answers[$i][2] == 1)
            {
                $answer = mb_convert_case($answer, MB_CASE_UPPER, "UTF-8");
                $taskAnswer = mb_convert_case($taskAnswer, MB_CASE_UPPER, "UTF-8");
            }

            if(strcmp($answer,$taskAnswer) != 0)
            {
                $isDone = false;
                break;
            }
        }
        return $isDone;
    }

}
