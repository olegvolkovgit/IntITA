<?php

/**
 * This is the model class for table "offline_groups_teacher_consultant_module".
 *
 * The followings are the available columns in table 'offline_groups_teacher_consultant_module':
 * @property integer $id
 * @property integer $id_group
 * @property integer $id_teacher
 * @property integer $id_module
 * @property string $start_date
 * @property string $end_date
 * @property integer $assigned_by
 * @property integer $cancelled_by
 *
 */
class OfflineGroupsTeacherConsultantModule extends CActiveRecord
{
    private $errorMessage = "";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'offline_groups_teacher_consultant_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_group, id_teacher, id_module, assigned_by', 'required'),
			array('id_teacher, id_module', 'numerical', 'integerOnly'=>true),
            array('id, id_group, id_teacher, id_module, start_date, end_date, assigned_by, cancelled_by', 'safe'),
			// The following rule is used by search().
			array('id, id_group, id_teacher, id_module, start_date, end_date, assigned_by, cancelled_by', 'safe', 'on'=>'search'),
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
			'teacher' => array(self::BELONGS_TO, 'StudentReg', 'id_teacher'),
            'module' => array(self::BELONGS_TO, 'Module', 'id_module'),
            'group' => array(self::BELONGS_TO, 'OfflineGroups', 'id_group'),
            'assigned_by_user' => array(self::BELONGS_TO, 'StudentReg', 'assigned_by'),
            'cancelled_by_user' => array(self::BELONGS_TO, 'StudentReg','cancelled_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id_group' => 'Id Group',
			'id_teacher' => 'Id Teacher',
			'id_module' => 'Id Module',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'assigned_by' => 'Assigned by',
            'cancelled_by' => 'Cancelled by',
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

        $criteria->compare('id_group',$this->id_group);
		$criteria->compare('id_teacher',$this->id_teacher);
		$criteria->compare('id_module',$this->id_module);
        $criteria->compare('start_date',$this->start_date);
        $criteria->compare('end_date',$this->end_date);
        $criteria->compare('assigned_by',$this->assigned_by,true);
        $criteria->compare('cancelled_by',$this->cancelled_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherConsultantModule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function checkBeforeCancelTeacherForModule()
    {
        if($this->group->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id ||
            $this->module->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id)
            return false;

        return true;
    }

    public function cancelTeacherForGroupModule()
    {
        $this->end_date=new CDbExpression('NOW()');
        $this->cancelled_by=Yii::app()->user->getId();
        if($this->save()){
            return true;
        }else{
            return false;
        }
    }

    public function checkGroupModule()
    {
        $model=Module::model()->findByPk($this->id_module);
        if($model->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id) {
            $this->errorMessage="Викладачу не можна призначити модуль, який не належить його організації";
            return false;
        }
        if (empty(Yii::app()->db->createCommand('select id_module from offline_groups_teacher_consultant_module where id_module=' . $this->id_module .
            ' and id_group='. $this->id_group.' and end_date IS NULL')->queryAll())) {
            return true;
        } else {
            $this->errorMessage = "Для даного модуля в групі вже призначено викладача";
            return false;
        }
    }

}