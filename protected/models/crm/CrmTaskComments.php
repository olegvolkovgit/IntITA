<?php

/**
 * This is the model class for table "crm_task_comments".
 *
 * The followings are the available columns in table 'crm_task_comments':
 * @property integer $id
 * @property integer $id_task
 * @property integer $id_parent
 * @property integer $id_user
 * @property string $create_date
 * @property string $change_date
 * @property string $message
 *
 * The followings are the available model relations:
 * @property CrmTaskComments $idParent
 * @property CrmTaskComments[] $crmTaskComments
 * @property CrmTasks $idTask
 * @property StudentReg $idUser
 */
class CrmTaskComments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_task_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_task, id_user, message', 'required'),
			array('id_task, id_parent, id_user', 'numerical', 'integerOnly'=>true),
			array('change_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_task, id_parent, id_user, create_date, change_date, message', 'safe', 'on'=>'search'),
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
			'idParent' => array(self::BELONGS_TO, 'CrmTaskComments', 'id_parent'),
			'crmTaskComments' => array(self::HAS_MANY, 'CrmTaskComments', 'id_parent'),
			'idTask' => array(self::BELONGS_TO, 'CrmTasks', 'id_task'),
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
			'id_task' => 'Id Task',
			'id_parent' => 'Id Parent',
			'id_user' => 'Id User',
			'create_date' => 'Create Date',
			'change_date' => 'Change Date',
			'message' => 'Message',
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
		$criteria->compare('id_parent',$this->id_parent);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('change_date',$this->change_date,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrmTaskComments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
