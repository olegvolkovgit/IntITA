<?php

/**
 * This is the model class for table "user_portfolio".
 *
 * The followings are the available columns in table 'user_portfolio':
 * @property integer $id
 * @property integer $id_user
 * @property string $file_name
 * @property string $upload_time
 * @property integer $check
 *
 * The followings are the available model relations:
 * @property StudentReg $idUser
 */
class UserPortfolio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_portfolio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, file_name', 'required'),
			array('id_user, check', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, file_name, upload_time, check', 'safe', 'on'=>'search'),
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
			'file_name' => 'File Name',
			'upload_time' => 'Upload Time',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('upload_time',$this->upload_time,true);
		$criteria->compare('check',$this->check);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPortfolio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function uploadPortfolioDocuments(){
        if (!file_exists(Yii::app()->basePath . "/../files/documents/portfolio/".Yii::app()->user->getId())) {
            mkdir(Yii::app()->basePath . "/../files/documents/portfolio/".Yii::app()->user->getId());
        }
        if(!empty($_FILES['file'])){
            $file = $_FILES['file']['name'];
            move_uploaded_file(
                $_FILES['file']["tmp_name"],
                Yii::getpathOfAlias('webroot').'/files/documents/portfolio/'.Yii::app()->user->getId().'/'.$file
            );

            $new_file=Yii::getpathOfAlias('webroot').'/files/documents/portfolio/'.Yii::app()->user->getId().'/'.$file;
            $files = new UserPortfolio();
            $files->id_user=Yii::app()->user->getId();
            $files->file_name=$file;
            if(!$files->save()){
                if (is_file($new_file))
                    unlink($new_file);
            }
        }else{
            throw new \application\components\Exceptions\IntItaException('500', 'Завантажити файл не вдалося');
        }
    }
}
