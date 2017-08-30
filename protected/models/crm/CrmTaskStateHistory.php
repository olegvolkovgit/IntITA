<?php

/**
 * This is the model class for table "crm_task_state_history".
 *
 * The followings are the available columns in table 'crm_task_state_history':
 * @property integer $id
 * @property integer $id_task
 * @property integer $id_state
 * @property integer $id_user
 * @property string $change_date
 *
 * The followings are the available model relations:
 * @property CrmTaskStatus $idState
 * @property CrmTasks $idTask
 * @property StudentReg $idUser
 */
class CrmTaskStateHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_task_state_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_task, id_user', 'required'),
			array('id_task, id_state, id_user', 'numerical', 'integerOnly'=>true),
			array('change_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_task, id_state, id_user, change_date', 'safe', 'on'=>'search'),
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
			'idState' => array(self::BELONGS_TO, 'CrmTaskStatus', 'id_state'),
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
			'id_state' => 'Id State',
			'id_user' => 'Id User',
			'change_date' => 'Change Date',
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
		$criteria->compare('id_state',$this->id_state);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('change_date',$this->change_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CrmTaskStateHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
