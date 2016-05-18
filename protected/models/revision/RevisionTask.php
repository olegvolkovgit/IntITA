<?php

/**
 * This is the model class for table "vc_task".
 *
 * The followings are the available columns in table 'vc_task':
 * @property integer $id
 * @property string $language
 * @property integer $assignment
 * @property integer $id_lecture_element
 * @property string $table
 * @property integer $id_test
 * @property integer $uid
 * @property integer $updated
 *
 * The followings are the available model relations:
 * @property RevisionLectureElement $lectureElement
 */
class RevisionTask extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_task';
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
			array('assignment, id_lecture_element, id_test, uid, updated', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>12),
			array('table', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, language, assignment, id_lecture_element, table, id_test, uid, updated', 'safe', 'on'=>'search'),
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

    public function behaviors(){
        return array(
            'uidUpdateBehavior' => array(
                'class' => 'RevisionQuizUidUpdateBehavior'
            ),
        );
    }

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'language' => 'Language',
			'assignment' => 'Assignment',
			'id_lecture_element' => 'Id Lecture Element',
			'table' => 'Table',
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
		$criteria->compare('language',$this->language,true);
		$criteria->compare('assignment',$this->assignment);
		$criteria->compare('id_lecture_element',$this->id_lecture_element);
		$criteria->compare('table',$this->table,true);
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
	 * @return RevisionTask the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function saveCheck($runValidation=true, $attributes=null) {
        if(!$this->save($runValidation,$attributes)) {
            throw new RevisionTaskException(implode("; ", $this->getErrors()));
        }
    }

    public static function createTest($idLectureElement, $assignment, $language, $table, $idModule, $idTest = null, $uid=null) {
        $newTask = new RevisionTask();
        $newTask->id_lecture_element = $idLectureElement;
        $newTask->assignment = $assignment;
        $newTask->language = $language;
        $newTask->table = $table;
        $newTask->id_test = $idTest;
        $newTask->uid = $uid ? $uid: RevisionQuizFactory::getQuizId($idModule);

        $newTask->saveCheck();

        return $newTask;
    }

    public function cloneTest($idLectureElement) {
        $newTask = new RevisionTask();
        $newTask->id_lecture_element = $idLectureElement;
        $newTask->setAttributes($this->getAttributes(['assignment', 'language', 'table', 'id_test', 'updated', 'id_test']));
        $newTask->uid = $this->uid;
        $newTask->saveCheck();
        return $newTask;
    }

    public function editTest($assignment, $language, $table) {
        $this->assignment = $assignment;
        $this->language = $language;
        $this->table = $table;
        $this->saveCheck();
        return;
    }

    public function deleteTest() {
        return;
    }

    public function saveToRegularDB($lectureElementId, $idUserCreated) {
        $task = Task::model()->findByAttributes(['uid' => $this->uid]);
        if ($task == null) {
            $newTask = new Task();
            $newTask->setAttributes($this->getAttributes(['assignment', 'language', 'table']));
            $newTask->author = $idUserCreated;
            $newTask->condition = $lectureElementId;
            $newTask->uid = $this->uid;
            $newTask->save();
            return $newTask;
        } else {
            $task->condition = $lectureElementId;
            $task->save();
        }
        return false;
    }

	public function cloneInterpreterJson($oldId) {
		$url = Config::getInterpreterServer();
//		$json= array(
//			"operation"=> "copyTask",
//			"task" => $this->uid,
//			"new_task" => $newId
//		);
//		$json=json_encode($json);
//		file_get_contents($url, false, stream_context_create(array(
//			'http' => array(
//				'method'  => 'POST',
//				'header'  => 'Content-type: application/x-www-form-urlencoded;charset=utf-8;',
//				'content' => $json
//			)
//		)));
		$json= array(
			'operation' => 'getJson',
			'task' => ($oldId)?$oldId:$this->id_test,
		);
		$json=json_encode($json);
		$result = file_get_contents($url, false, stream_context_create(array(
			'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded;charset=utf-8;',
				'content' => $json
			)
		)));
		//todo
		$result=json_decode($result)->json;
		$pos = strpos($result,'"task":"'.$oldId.'"');
		$newJson= $pos!==false ? substr_replace($result, '"task":'.$this->uid, $pos, strlen('"task":"'.$oldId.'"')) : $result;
		if(!$pos){
			$pos = strpos($result,'"task":'.$oldId);
			$newJson= $pos!==false ? substr_replace($result, '"task":'.$this->uid, $pos, strlen('"task":'.$oldId)) : $result;
		}
		file_get_contents($url, false, stream_context_create(array(
			'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded;charset=utf-8;',
				'content' => $newJson
			)
		)));
	}
	//Check the existence of the task in the Interpreter DB
	public function existenceInterpreterTask() {
		$url = Config::getInterpreterServer();
		$json= array(
			'operation' => 'getJson',
			'task' => $this->uid,
		);
		$json=json_encode($json);
		$result = file_get_contents($url, false, stream_context_create(array(
			'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded;charset=utf-8;',
				'content' => $json
			)
		)));
		if(json_decode($result)->status=='failed')
			return false;
		else return true;
	}
}
