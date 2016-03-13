<?php

/**
 * This is the model class for table "vc_lecture".
 *
 * The followings are the available columns in table 'vc_lecture':
 * @property integer $id_revision
 * @property integer $id_parent
 * @property integer $id_lecture
 * @property integer $id_module
 * @property integer $id_properties
 *
 * The followings are the available model relations:
 * @property properties $idProperties
 * @property LecturePage[] $lecturePages
 */
class RevisionLecture extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_lecture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_parent, id_lecture, id_module, id_properties', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_revision, id_parent, id_lecture, id_module, id_properties', 'safe', 'on'=>'search'),
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
			'properties' => array(self::HAS_ONE, 'RevisionLectureProperties', 'id'),
			'lecturePages' => array(self::HAS_MANY, 'RevisionLecturePage', 'id_revision',
                                                        'order' => 'page_order ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_revision' => 'Id Revision',
			'id_parent' => 'Id Parent',
			'id_lecture' => 'Id Lecture',
			'id_module' => 'Id Module',
			'id_properties' => 'Id Properties',
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

		$criteria->compare('id_revision',$this->id_revision);
		$criteria->compare('id_parent',$this->id_parent);
		$criteria->compare('id_lecture',$this->id_lecture);
		$criteria->compare('id_module',$this->id_module);
		$criteria->compare('id_properties',$this->id_properties);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionLecture the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function createNewLecture($idModule, $order, $titleUa, $titleEn, $titleRu, $user) {
		$revLectureProperties =  new RevisionLectureProperties();
		$revLectureProperties->initialize($order, $titleUa, $titleEn, $titleRu, $user);

		$revLecture = new RevisionLecture();
		$revLecture->id_module = $idModule;
        $revLecture->id_properties = $revLectureProperties->id;

        if(!$revLecture->save()) {
            throw new RevisionLectureException(implode("; ", $revLecture->getErrors()));
        }

        $revLecturePage = new RevisionLecturePage();
        $revLecturePage->initialize($revLecture->id_revision, $user);

		return $revLecture;
	}

    public function addPage($user){
        $revLecturePage = new RevisionLecturePage();

        $revLecturePage->initialize($this->id_revision, $user, $this->getLastPageOrder()+1);
    }

    private function getLastPageOrder(){
        return $this->lecturePages[count($this->lecturePages)-1]->page_order;
    }
}
