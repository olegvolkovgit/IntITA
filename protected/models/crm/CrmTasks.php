<?php

/**
 * This is the model class for table "crm_tasks".
 *
 * The followings are the available columns in table 'crm_tasks':
 * @property integer $id
 * @property string $name
 * @property string $body
 * @property string $startTask
 * @property string $endTask
 * @property string $deadline
 * @property integer $id_state
 * @property integer $created_by
 * @property string $created_date
 * @property integer $cancelled_by
 * @property string $cancelled_date
 * @property string $change_date
 *
 * The followings are the available model relations:
 * @property CrmRolesTasks[] $crmRolesTasks
 * @property StudentReg $cancelledBy
 * @property StudentReg $createdBy
 * @property CrmTaskStatus $taskState
 */
class CrmTasks extends CTaskUnitActiveRecord
{
    const EXECUTANT = 1;
    const PRODUCER = 2;
    const COLLABORATOR = 3;
    const OBSERVER = 4;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'crm_tasks';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, body, created_by', 'required', 'message' => '{attribute} обов\'язкове для заповнення'),
            array('id_state, created_by, cancelled_by', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('endTask, deadline, cancelled_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, body, startTask, endTask, deadline, id_state, created_by, created_date, cancelled_by, cancelled_date, change_date', 'safe', 'on' => 'search'),
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
            'crmRolesTasks' => array(self::HAS_MANY, 'CrmRolesTasks', 'id_task'),
            'cancelledBy' => array(self::BELONGS_TO, 'StudentReg', 'cancelled_by'),
            'createdBy' => array(self::BELONGS_TO, 'StudentReg', 'created_by'),
            'taskState' => array(self::BELONGS_TO, 'CrmTaskStatus', 'id_state'),
            'executant' => array(self::HAS_ONE, 'CrmRolesTasks', 'id_task', 'on' => 'executant.cancelled_date IS NULL and executant.role = ' . CrmTasks::EXECUTANT),
            'producer' => array(self::HAS_ONE, 'CrmRolesTasks', 'id_task', 'on' => 'producer.cancelled_date IS NULL and producer.role = ' . CrmTasks::PRODUCER),
            'collaborators' => array(self::HAS_MANY, 'CrmRolesTasks', 'id_task', 'on' => 'collaborators.cancelled_date IS NULL and collaborators.role = ' . CrmTasks::COLLABORATOR),
            'observers' => array(self::HAS_MANY, 'CrmRolesTasks', 'id_task', 'on' => 'observers.cancelled_date IS NULL and observers.role = ' . CrmTasks::OBSERVER),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Назва завдання',
            'body' => 'Текст завдання',
            'startTask' => 'Початок завдання',
            'endTask' => 'Завершення завдання',
            'deadline' => 'Крайній термін',
            'id_state' => 'Статус',
            'created_by' => 'Створено користувачем',
            'created_date' => 'Дата створення',
            'cancelled_by' => 'Скасовано користувачем',
            'cancelled_date' => 'Дата скасування',
            'change_date' => 'Дата оновлення',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('body', $this->body, true);
        $criteria->compare('startTask', $this->startTask, true);
        $criteria->compare('endTask', $this->endTask, true);
        $criteria->compare('deadline', $this->deadline, true);
        $criteria->compare('id_state', $this->id_state);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('cancelled_by', $this->cancelled_by);
        $criteria->compare('cancelled_date', $this->cancelled_date, true);
        $criteria->compare('change_date', $this->change_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CrmTasks the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getValidationErrors()
    {
        $errors = [];
        foreach ($this->getErrors() as $key => $attribute) {
            foreach ($attribute as $error) {
                array_push($errors, $error);
            }
        }
        return implode(", ", $errors);
    }

    /**
     * Initialize crm task
     * @param $params
     */
    public function initialize($params)
    {
        $this->attributes = $params;
        $this->created_by = Yii::app()->user->getId();
        $this->id_state = TaskState::ExpectsToExecute;

        $this->saveCheck();
    }

    public function setRoles($roles)
    {
        foreach ($roles as $key => $role) {
            if (is_null($role)) $role = [];
            switch ($key) {
                case 'executant':
                    $roleId = self::EXECUTANT;
                    break;
                case 'producer';
                    $roleId = self::PRODUCER;
                    break;
                case 'collaborator';
                    $roleId = self::COLLABORATOR;
                    break;
                case 'observer';
                    $roleId = self::OBSERVER;
                    break;
                default:
                    $roleId = self::EXECUTANT;
                    break;
            };
            $oldUsers = [];
            $newUsers = [];
            foreach (CrmRolesTasks::model()->findAllByAttributes(array('id_task' => $this->id, 'role' => $roleId, 'cancelled_date' => null)) as $item) {
                array_push($oldUsers, $item->id_user);
            }

            if ($roleId == self::PRODUCER || $roleId == self::EXECUTANT) {
                $user = isset($role['id']) ? $role['id'] : Yii::app()->user->getId();
                array_push($newUsers, $user);
            } else {
                foreach ($role as $item) {
                    array_push($newUsers, $item['id']);
                }
            }

            $addUsers = array_diff($newUsers, $oldUsers);
            $cancelUsers = array_diff($oldUsers, $newUsers);
            $this->setRolesTask($addUsers, $roleId);
            $this->cancelRolesTask($cancelUsers, $roleId);

            if ($roleId == self::EXECUTANT) {
                if (!count(CrmRolesTasks::model()->findAllByAttributes(array('id_task' => $this->id, 'role' => $roleId, 'cancelled_date' => null)))){
                    $this->setRolesTask([Yii::app()->user->getId()], $roleId);
                }
            }
        }
    }

    public function setRolesTask($usersId, $role)
    {
        foreach ($usersId as $user) {
            $model = new CrmRolesTasks();
            $model->id_task = $this->id;
            $model->id_user = $user;
            $model->role = $role;
            $model->assigned_by = Yii::app()->user->getId();
            $model->save();
        }
    }

    public function cancelRolesTask($usersId, $role)
    {
        foreach ($usersId as $user) {
            $model = CrmRolesTasks::model()->findByAttributes(array('id_task' => $this->id, 'id_user' => $user, 'role' => $role, 'cancelled_date' => null));
            $model->cancelled_by = Yii::app()->user->getId();
            $model->cancelled_date = new CDbExpression('NOW()');
            $model->save();
        }
    }

    /**
     * Save crmTasks model with error checking
     * @throws Exception
     */
    public function saveCheck()
    {
        if (!$this->save()) {
            throw new Exception(json_encode($this->getValidationErrors()));
        }
    }

    public function getStringState($id)
    {
        switch ($id) {
            case 1:
                $state = 'ExpectToExecute';
                break;
            case 2;
                $state =  'Executed';
                break;
            case 3;
                $state =  'Paused';
                break;
            case 4;
                $state =  'Completed';
                break;
            default:
                $state =  'ExpectToExecute';
                break;
        };

        return $state;
    }
}
