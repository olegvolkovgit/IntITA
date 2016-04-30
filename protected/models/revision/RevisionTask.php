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
			array('id_lecture_element', 'required'),
			array('assignment, id_lecture_element, id_test', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>12),
			array('table', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, language, assignment, id_lecture_element, table, id_test', 'safe', 'on'=>'search'),
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
			'language' => 'Language',
			'assignment' => 'Assignment',
			'id_lecture_element' => 'Id Lecture Element',
			'table' => 'Table',
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
		$criteria->compare('language',$this->language,true);
		$criteria->compare('assignment',$this->assignment);
		$criteria->compare('id_lecture_element',$this->id_lecture_element);
		$criteria->compare('table',$this->table,true);
		$criteria->compare('id_test',$this->id_test);

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

    public static function createTest($idLectureElement, $assignment, $language, $table, $idTest=null) {
        $newTask = new RevisionTask();
        $newTask->id_lecture_element = $idLectureElement;
        $newTask->assignment = $assignment;
        $newTask->language = $language;
        $newTask->table = $table;

        $newTask->id_test = $idTest;

        $newTask->saveCheck();

        return $newTask;
    }

    public function cloneTest($idLectureElement) {
        $newTask = new RevisionTask();
        $newTask->id_lecture_element = $idLectureElement;
        $newTask->setAttributes($this->getAttributes(['assignment', 'language', 'table', 'id_test']));

        $newTask->saveCheck();
        return $newTask;
    }

    public function editTest($assignment, $language, $table) {

        //todo what for this fields uses
        $newTask = new RevisionTask();
        $newTask->assignment = $assignment;
        $newTask->language = $language;
        $newTask->table = $table;
        return;
    }

    public function deleteTest() {
        return;
    }

    public function saveToRegularDB($lectureElementId, $idUserCreated) {
        $newTask = new Task();
        $newTask->setAttributes($this->getAttributes(['assignment', 'language', 'table']));
        $newTask->author = $idUserCreated;
        $newTask->condition = $lectureElementId;

        $newTask->save();

        return $newTask;
    }
}
