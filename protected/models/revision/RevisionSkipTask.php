<?php

/**
 * This is the model class for table "vc_skip_task".
 *
 * The followings are the available columns in table 'vc_skip_task':
 * @property integer $id
 * @property integer $condition
 * @property string $question
 * @property string $source
 * @property integer $id_test
 * @property integer $uid
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property RevisionLectureElement $lectureElement
 * @property RevisionSkipTaskAnswers[] $answers
 */
class RevisionSkipTask extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vc_skip_task';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('condition, question, source, uid', 'required'),
            array('condition, id_test, uid, updated', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, condition, question, source, id_test, uid, updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'lectureElement' => array(self::BELONGS_TO, 'RevisionLectureElement', 'condition'),
            'answers' => array(self::HAS_MANY, 'RevisionSkipTaskAnswers', 'id_task'),
        );
    }

    public function behaviors() {
        return array(
            'uidUpdateBehavior' => array(
                'class' => 'RevisionQuizUidUpdateBehavior'
            ),
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'condition' => 'Condition',
            'question' => 'Question',
            'source' => 'Source',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('condition', $this->condition);
        $criteria->compare('question', $this->question, true);
        $criteria->compare('source', $this->source, true);
        $criteria->compare('id_test', $this->id_test);
        $criteria->compare('uid', $this->uid);
        $criteria->compare('updated', $this->updated);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RevisionSkipTask the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function saveCheck($runValidation = true, $attributes = null) {
        if (!$this->save($runValidation, $attributes)) {
            throw new RevisionSkipTaskException(implode("; ", $this->getErrors()));
        }
    }

    public static function createTest($lectureElementId, $question, $source, $answers, $idModule, $idTest = null, $uid = null) {
        $newTest = new RevisionSkipTask();
        $newTest->condition = $lectureElementId;
        $newTest->question = $question;
        $newTest->source = $source;
        $newTest->uid = $uid ? $uid: RevisionQuizFactory::getQuizId($idModule);
        $newTest->id_test = $idTest;

        $newTest->saveCheck();

        foreach ($answers as $answer) {
            RevisionSkipTaskAnswers::createAnswer($newTest->id, $answer['value'], $answer['caseInsensitive'], $answer['index'], $newTest->uid);
        }

        return $newTest;
    }

    public function cloneTest($lectureElementId) {
        $newTest = new RevisionSkipTask();
        $newTest->condition = $lectureElementId;
        $newTest->question = $this->question;
        $newTest->source = $this->source;
        $newTest->id_test = $this->id_test;
        $newTest->uid = $this->uid;
        $newTest->updated = $this->updated;
        $newTest->id_test = $this->id_test;
        $newTest->saveCheck();

        foreach ($this->answers as $answer) {
            $answer->cloneAnswer($newTest->id, $newTest->uid);
        }

        return $newTest;
    }

    public function editTest($question, $source, $answers) {
        $this->question = $question;
        $this->source = $source;
        $this->saveCheck();

        $oldCount = count($this->answers);
        $newCount = count($answers);

        $i = 0;
        $length = min($oldCount, $newCount);
        for (; $i < $length; $i++) {
            $this->answers[$i]->edit($answers[$i]['value'], $answers[$i]['caseInsensitive'], $answers[$i]['index']);
        }

        if ($oldCount < $newCount) {
            for (; $i < $newCount; $i++) {
                RevisionSkipTaskAnswers::createAnswer($this->id, $answers[$i]['value'], $answers[$i]['caseInsensitive'], $answers[$i]['index'], $this->uid);
            }
        } elseif ($oldCount > $newCount) {
            $pkToDelete = [];
            for (; $i < $oldCount; $i++) {
                array_push($pkToDelete, $this->answers[$i]->id);
            }
            RevisionSkipTaskAnswers::model()->deleteByPk($pkToDelete);
        }

        return $this;
    }

    public function deleteTest() {
    }

    /**
     * @return bool|void
     * @throws CDbException
     */
    protected function beforeDelete() {
        foreach ($this->answers as $answer) {
            if (!$answer->delete()) {
                return false;
            }
        }
        return parent::beforeDelete();
    }

    /**
     * @param LectureElement $lectureElement
     * @param $idUserCreated
     * @return SkipTask
     */
    public function saveToRegularDB($lectureElement, $idUserCreated) {
        //todo;
        $skipTask = SkipTask::model()->findByAttributes(['uid' => $this->uid]);

        $questionLE = new LectureElement();
        $questionLE->block_order = 0;
        $questionLE->html_block = $this->question;
        $questionLE->id_lecture = $lectureElement->id_lecture;
        $questionLE->id_type = LectureElement::SKIP_TASK;
        $questionLE->save();

        if ($skipTask == null) {

            $skipTask = new SkipTask();
            $skipTask->author = $idUserCreated;
            $skipTask->condition = $lectureElement->id_block;
            $skipTask->question = $questionLE->id_block;
            $skipTask->source = $this->source;
            $skipTask->uid = $this->uid;
            $skipTask->save();

            foreach ($this->answers as $answer) {
                $answer->saveToRegularDB($skipTask->id);
            }
            return $skipTask;
        } else {
            $skipTask->condition = $lectureElement->id_block;
            $skipTask->question = $questionLE->id_block;
            $skipTask->save();
        }
        return false;
    }
}
