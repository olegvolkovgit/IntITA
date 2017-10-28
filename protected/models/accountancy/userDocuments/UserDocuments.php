<?php

/**
 * This is the model class for table "acc_user_documents".
 *
 * The followings are the available columns in table 'acc_user_documents':
 * @property integer $id
 * @property integer $id_user
 * @property integer $type
 * @property string $number
 * @property string $issued
 * @property string $issued_date
 * @property string $registration_address
 * @property string $updatedAt
 * @property integer $actual
 * @property integer $checked
 * @property string $checked_date
 * @property string $description
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 *
 * The followings are the available model relations:
 * @property DocumentsFiles[] $documentsFiles
 * @property StudentReg $checkedBy
 * @property DocumentsTypes $documentType
 * @property StudentReg $idUser
 */
class UserDocuments extends CActiveRecord
{
    const CHECKED=1;
    const NOT_CHECKED=0;
    const ACTUAL = 1;
    const NOT_ACTUAL = 0;

    public $issuedDate=null;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_user_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, type', 'required'),
			array('id_user, type, actual, checked', 'numerical', 'integerOnly'=>true),
			array('number, issued, registration_address, description', 'length', 'max'=>255),
			array('id, id_user, type, number, issued, issued_date, registration_address, updatedAt, 
			actual, checked, checked_date, description, first_name, last_name, middle_name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, type, number, issued, issued_date, registration_address, updatedAt, 
			actual, checked, checked_date, description, first_name, last_name, middle_name', 'safe', 'on'=>'search'),
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
			'documentsFiles' => array(self::HAS_MANY, 'DocumentsFiles', 'id_document'),
			'documentType' => array(self::BELONGS_TO, 'DocumentsTypes', 'type'),
			'idUser' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
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
			'type' => 'Type',
			'number' => 'Number',
			'issued' => 'Issued',
			'issued_date' => 'Issued Date',
			'registration_address' => 'Registration Address',
			'updatedAt' => 'Updated At',
			'actual' => 'Actual',
			'checked' => 'Checked',
			'checked_date' => 'Checked Date',
			'description' => 'Description',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('issued',$this->issued,true);
		$criteria->compare('issued_date',$this->issued_date,true);
		$criteria->compare('registration_address',$this->registration_address,true);
		$criteria->compare('updatedAt',$this->updatedAt,true);
		$criteria->compare('actual',$this->actual);
		$criteria->compare('checked',$this->checked);
		$criteria->compare('checked_date',$this->checked_date,true);
		$criteria->compare('description',$this->description,true);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('middle_name',$this->middle_name,true);

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

    public function scopes() {
        return [
            'lastEditedDocuments' => [
                'alias'=>'ld',
                'order' => 'ld.updatedAt DESC',
                'condition' => 'ld.actual='.self::ACTUAL,
            ]
        ];
    }

    public function afterFind() {
        if($this->issued_date){
            $date = str_replace('-', '/', $this->issued_date);
            $this->issuedDate=date("d/m/Y", strtotime($date));
        }

        parent::afterFind();
    }

    protected function beforeDelete()
    {
        if($this->checked==UserDocuments::CHECKED)
            return false;

        return parent::beforeDelete();
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

            $documents=UserDocuments::model()->findByAttributes(
                array('id_user'=>Yii::app()->user->getId(),'checked'=>UserDocuments::NOT_CHECKED,'type'=>$type)
            );
            $files = new DocumentsFiles();
            $files->file_name=$newImageName;
            $files->id_document=$documents->id;
            if(!$files->save()){
                if (is_file($new_file))
                    unlink($new_file);
            }
        }else{
            throw new \application\components\Exceptions\IntItaException('500', 'Завантажити файл не вдалося');
        }
    }
}
