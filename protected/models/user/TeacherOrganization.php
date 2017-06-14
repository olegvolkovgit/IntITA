<?php

/**
 * This is the model class for table "teacher_organization".
 *
 * The followings are the available columns in table 'teacher_organization':
 * @property integer $id_user
 * @property integer $id_organization
 * @property boolean $isPrint
 * @property string $start_date
 * @property string $end_date
 * @property integer $assigned_by
 * @property integer $cancelled_by
 *
 * @property StudentReg $user
 */
class TeacherOrganization extends CActiveRecord
{
    const SHOW = 1;
    const HIDE = 0;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'teacher_organization';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user, id_organization, assigned_by', 'required', 'message' => 'Поле не може бути пустим'),
            array('id_user, id_organization, assigned_by, isPrint, start_date, end_date, cancelled_by', 'safe'),
            // The following rule is used by search().
            array('id_user, id_organization, assigned_by, isPrint, start_date, end_date, cancelled_by', 'safe', 'on' => 'search'),
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
            'teacher' => array(self::BELONGS_TO, 'Teacher', ['id_user'=>'user_id']),
            'assigned_by_user' => array(self::BELONGS_TO, 'StudentReg', ['assigned_by'=>'id']),
            'cancelled_by_user' => array(self::BELONGS_TO, 'StudentReg',['cancelled_by'=>'id']),
            'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_user' => 'Id user',
            'id_organization' => 'Id organization',
            'isPrint' => 'Is print',
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
        $criteria = new CDbCriteria;
        $criteria->compare('id_user', $this->id_user, true);
        $criteria->compare('id_organization', $this->id_organization, true);
        $criteria->compare('isPrint', $this->isPrint, true);
        $criteria->compare('start_date', $this->start_date);
        $criteria->compare('end_date', $this->end_date);
        $criteria->compare('assigned_by', $this->assigned_by);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('isPrint', $this->isPrint);
        $criteria->compare('cancelled_by', $this->cancelled_by, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TeacherOrganization the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey(){
        return array('id_user','id_organization');
    }

    public function getValidationErrors() {
        $errors=[];
        foreach($this->getErrors() as $key=>$attribute){
            foreach($attribute as $error){
                array_push($errors,$error);
            }
        }
        return implode(", ", $errors);
    }

    public function setShowMode(){
        $this->isPrint = TeacherOrganization::SHOW;
        return $this->save();
    }

    public function setHideMode(){
        $this->isPrint = TeacherOrganization::HIDE;
        return $this->save();
    }

    public function isShow(){
        return $this->isPrint == TeacherOrganization::SHOW;
    }

    public function isHide(){
        return $this->isPrint == TeacherOrganization::HIDE;
    }

    public function cancelTeacherRoles(){
        $organization=Yii::app()->session['organization'];
        $user=RegisteredUser::userById($this->id_user);
        $roles = $user->getTeacherRoles($organization);
        foreach ($roles as $role){
            $roleObj = Role::getInstance($role);
            $roleObj->cancelRole($user->registrationData, $organization);
        }
    }

    public function getRolesByOrganization() // !!!
    {
        $sql = '';
        $id_org = $this->id_organization;
        $roles = AllRolesDataSource::teacherRoles();
        $lastKey = array_search(end($roles), $roles);

        foreach($roles as $key=>$role){
            $model = Role::getInstance($role);
            $sql .= "(".$model->checkRoleSql($id_org).")";
            if ($key != $lastKey) {
                $sql .= " union ";
            }
        }
        $rolesArray = Yii::app()->db->createCommand($sql)->bindValue(":id", $this->id_user, PDO::PARAM_STR)->queryAll();
        $result = array_map(function ($row) {
            return $row["accountant"];
        }, $rolesArray);

        return $result;
    }

    public function getUserRoles()
    {
        $roles = $this->getRolesByOrganization();
        $result=array();

        foreach($roles as $role){
            array_push($result, Role::getInstance($role)->title());
        }
        return implode(", ", $result);
    }

    public function getModules()
    {
        $models = $this->teacher->modulesActive;
        return array_filter($models, function($model){
            return $model->id_organization == $this->id_organization;
        });
    }
}
