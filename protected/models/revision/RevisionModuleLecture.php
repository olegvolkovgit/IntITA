<?php

/**
 * This is the model class for table "vc_module_lecture".
 *
 * The followings are the available columns in table 'vc_module_lecture':
 * @property integer $id
 * @property integer $id_lecture_revision
 * @property integer $id_module_revision
 * @property integer $lecture_order
 */

class RevisionModuleLecture extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_module_lecture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lecture_revision, id_module_revision, lecture_order', 'required'),
			array('id_lecture_revision, id_module_revision, lecture_order', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lecture_revision, id_module_revision, lecture_order', 'safe', 'on'=>'search'),
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
            //todo IN condition doesn't work!;
			'revision' => array(self::BELONGS_TO, 'RevisionModule', 'id_module_revision'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'id_lecture_revision' => 'Id Lecture Revision',
            'id_module_revision' => 'Id Module Revision',
			'lecture_order' => 'Lecture Order',
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
		$criteria->compare('id_lecture_revision',$this->id_lecture_revision);
		$criteria->compare('id_module_revision',$this->id_module_revision);
		$criteria->compare('lecture_order',$this->lecture_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionLecturePage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Clone revision
	 * Returns new lecture instance or current instance if the lecture is not cloneable
	 * @param null $idNewRevision
	 * @return RevisionModuleLecture
	 * @throws Exception
	 */
	public function cloneLecture($idNewRevision = null) {

		if ($idNewRevision == null) {
			$idNewRevision = $this->id_module_revision;
		}

		$connection = Yii::app()->db;
		$transaction = null;

		if ($connection->getCurrentTransaction() == null) {
			$transaction = $connection->beginTransaction();
		}

		try {
			$newRevision = new RevisionModuleLecture();
			
			$newRevision->id_lecture_revision = $this->id_lecture_revision;
			$newRevision->id_module_revision = $idNewRevision;
			$newRevision->lecture_order = $this->lecture_order;
			$newRevision->saveCheck();

			if ($transaction != null) {
				$transaction->commit();
			}
		} catch (Exception $e) {
			if ($transaction != null) {
				$transaction->rollback();
			}
			throw $e;
		}

		return $newRevision;
	}
	
	public function saveCheck($runValidation=true,$attributes=null) {
		if(!$this->save($runValidation,$attributes)) {
			throw new RevisionModuleException('400',$this->getValidationErrors());
		}
	}
	
    public function getValidationErrors() {
        $errors=[];
        foreach($this->getErrors() as $attribute){
            foreach($attribute as $error){
                array_push($errors,$error);
            }
        }
        return $errors[0];
    }

	public function cloneModuleLecture($idNewRevision = null) {

		if ($idNewRevision == null) {
			$idNewRevision = $this->id_module_revision;
		}

		$connection = Yii::app()->db;
		$transaction = null;

		if ($connection->getCurrentTransaction() == null) {
			$transaction = $connection->beginTransaction();
		}

		try {
			$newRevision = new RevisionModuleLecture();

			$newRevision->id_lecture_revision = $this->id_lecture_revision;
			$newRevision->id_module_revision = $idNewRevision;
			$newRevision->lecture_order = $this->lecture_order;

			$newRevision->saveCheck();

			if ($transaction != null) {
				$transaction->commit();
			}
		} catch (Exception $e) {
			if ($transaction != null) {
				$transaction->rollback();
			}
			throw $e;
		}

		return $newRevision;
	}

}
