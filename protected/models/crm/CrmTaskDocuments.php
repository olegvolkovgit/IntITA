<?php

/**
 * This is the model class for table "crm_task_documents".
 *
 * The followings are the available columns in table 'crm_task_documents':
 * @property integer $id
 * @property integer $id_task
 * @property string $file_name
 * @property integer $uploaded_by
 * @property string $upload_time
 *
 * The followings are the available model relations:
 * @property StudentReg $idTask
 * @property StudentReg $uploadedBy
 */
class CrmTaskDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_task_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_task, file_name', 'required'),
			array('id_task, uploaded_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_task, file_name, uploaded_by, upload_time', 'safe', 'on'=>'search'),
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
			'idTask' => array(self::BELONGS_TO, 'StudentReg', 'id_task'),
			'uploadedBy' => array(self::BELONGS_TO, 'StudentReg', 'uploaded_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_task' => 'Id Task',
			'file_name' => 'File Name',
			'uploaded_by' => 'Uploaded By',
			'upload_time' => 'Upload Time',
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
		$criteria->compare('id_task',$this->id_task);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('uploaded_by',$this->uploaded_by);
		$criteria->compare('upload_time',$this->upload_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrmTaskDocuments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function uploadDocument($task){
        if (!file_exists(Yii::app()->basePath . "/../files/crm/tasks/".$task)) {
            mkdir(Yii::app()->basePath . "/../files/crm/tasks/".$task,777, true);
        }
        if(!empty($_FILES['file'])){
            $ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            $file = time().'.'.$ext;
            $path = Yii::getpathOfAlias('webroot').'/files/crm/tasks/'.$task.'/'.$file;
            move_uploaded_file($_FILES['file']["tmp_name"], $path);
            $files = new CrmTaskDocuments();
            $files->file_name = $file;
            $files->uploaded_by = Yii::app()->user->getId();
            $files->id_task = $task;
            if(!$files->save()){
                if (is_file($path))
                    unlink($path);
            }
        }else{
            throw new \application\components\Exceptions\IntItaException('500', 'Завантажити файл не вдалося');
        }
    }
}
