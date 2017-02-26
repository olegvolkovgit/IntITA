<?php

/**
 * This is the model class for table "user_documents".
 *
 * The followings are the available columns in table 'user_documents':
 * @property integer $id
 * @property integer $id_user
 * @property string $type
 * @property string $file_name
 * @property string $upload_time
 * @property boolean $check
 *
 * The followings are the available model relations:
 */
class UserDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, type, file_name', 'required'),
			array('id, id_user, type, file_name, upload_time, check', 'safe'),
			// The following rule is used by search().
			array('id, id_user, type, file_name, upload_time, check', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id user',
			'type' => 'Type',
			'file_name' => 'File name',
			'upload_time' => 'Upload_time',
			'check' => 'Check',
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

        $criteria=new CDbCriteria;

        $criteria->compare('id_user',$this->id_user, true);
        $criteria->compare('type', $this->type,true);
		$criteria->compare('file_name',$this->file_name, true);
		$criteria->compare('upload_time',$this->upload_time, true);
		$criteria->compare('check',$this->check, true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserDocuments the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

	public function uploadUserDocuments($type){
		if (!file_exists(Yii::app()->basePath . "/../files/documents/".Yii::app()->user->getId())) {
			mkdir(Yii::app()->basePath . "/../files/documents/".Yii::app()->user->getId());
		}
		if (!file_exists(Yii::app()->basePath . "/../files/documents/".Yii::app()->user->getId()."/".$type)) {
			mkdir(Yii::app()->basePath . "/../files/documents/".Yii::app()->user->getId()."/".$type);
		}

		if(!empty($_FILES['file'])){
			$ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			$image = time().'.'.$ext;
			move_uploaded_file(
				$_FILES['file']["tmp_name"],
				Yii::getpathOfAlias('webroot').'/files/documents/'.Yii::app()->user->getId().'/'.$type.'/'.$image
			);
			$newImageName='m'.$image;
			$original_file=Yii::getpathOfAlias('webroot').'/files/documents/'.Yii::app()->user->getId().'/'.$type.'/'.$image;
			$new_file=Yii::getpathOfAlias('webroot').'/files/documents/'.Yii::app()->user->getId().'/'.$type.'/'.$newImageName;
			ImageHelper::uploadAndResizeImg(
				$original_file,
				$new_file,
				500
			);
			if (is_file($original_file))
				unlink($original_file);
			$model = new UserDocuments();
			$model->id_user=Yii::app()->user->getId();
			$model->type=$type;
			$model->file_name=$newImageName;
			if(!$model->save()){
				if (is_file($new_file))
					unlink($new_file);
			}
		}else{
			throw new \application\components\Exceptions\IntItaException('500', 'Завантажити файл не вдалося');
		}
	}

	public function changeCheckDocuments(){
		if($this->check) 
			$this->check = false;
		else $this->check = true;
		$this->save();
	}
}
