<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisteredUser
 *
 * @author alterego4
 */
class RegisteredUser
{
    //StudentReg variable
    public $registrationData;
    //array UserRoles
    private $_roles;
    //Teacher model
    private $_teacher;
    private $_isTeacher = false;
    private $_roleAttributes = array();

    public function __construct(StudentReg $registrationData)
    {
        $this->registrationData = $registrationData;
    }

    public static function userById($id = null)
    {
        if (($id !== null) && (($registrationData = StudentReg::model()->findByPk($id)) !== null)) {
            return new RegisteredUser($registrationData);
        }
        throw new \application\components\Exceptions\IntItaException('404', 'Такого користувача немає');
    }

    //Model Methods
    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->registrationData, $name), $arguments);
    }

    public function __get($name)
    {
        return $this->registrationData->$name;
    }

    public function getRoles()
    {
        if ($this->_roles === null) {

            $this->_roles = $this->loadRoles();
        }
        return $this->_roles;
    }

    private function loadRoles()
    {
        $sql = '';
        $roles = AllRolesDataSource::roles();
        $lastKey = array_search(end($roles), $roles);
        foreach($roles as $key=>$role){
            $model = Role::getInstance($role);
            $sql .= "(".$model->checkRoleSql().")";
            if ($key != $lastKey) {
                $sql .= " union ";
            }
        }

        $rolesArray = Yii::app()->db->createCommand($sql)->bindValue(":id",$this->id,PDO::PARAM_STR)->queryAll();

        $result = array_map(function ($row) {
            return new UserRoles($row["admin"]);
        }, $rolesArray);

        return $result;
    }

    public function isTeacher()
    {
        if ($this->getTeacher() === null) {
            return false;
        } else {
            return true;
        }
    }

    public function getTeacher()
    {
        if ($this->_teacher === null) {

            $this->_teacher = $this->loadTeacherModel();
        }
        return $this->_teacher;
    }

    private function loadTeacherModel()
    {
        return Teacher::model()->findByAttributes(array('user_id' => $this->registrationData->id));
    }

    public function getRolesAttributes()
    {
        if (empty($this->_roleAttributes)) {
            foreach ($this->getRoles() as $role) {
                $this->loadAttributes($role);
            }
        }
        return $this->_roleAttributes;
    }

    public function getAttributesByRole($role)
    {
        if (empty($this->_roleAttributes[(string)$role])) {
            $this->loadAttributes($role);
        }
        return $this->_roleAttributes[(string)$role];
    }

    private function loadAttributes($role)
    {
        if ($this->hasRole($role)) {
            $roleObj = Role::getInstance($role);
            $this->_roleAttributes[(string)$role] = $roleObj->attributes($this->registrationData);
        }
        return $this->_roleAttributes[(string)$role];
    }

    public function setRoleAttribute($role, $attribute, $value)
    {
        $roleObj = Role::getInstance($role);
        return $roleObj->setAttribute($this->registrationData, $attribute, $value);
    }

    public function unsetRoleAttribute($role, $attribute, $value)
    {
        $roleObj = Role::getInstance($role);
        return $roleObj->cancelAttribute($this->registrationData, $attribute, $value);
    }

    public function isAdmin()
    {
        return $this->hasRole(UserRoles::ADMIN);
    }

    public function isAccountant()
    {
        return $this->hasRole(UserRoles::ACCOUNTANT);
    }

    public function isTrainer()
    {
        return $this->hasRole(UserRoles::TRAINER);
    }

    public function isTeacherConsultant()
    {
        return $this->hasRole(UserRoles::TEACHER_CONSULTANT);
    }

    public function isContentManager()
    {
        return $this->hasRole(UserRoles::CONTENT_MANAGER);
    }

    public function isTenant()
    {
        return $this->hasRole(UserRoles::TENANT);
    }


    public function isConsultant()
    {
        return $this->hasRole(UserRoles::CONSULTANT);
    }

    public function isStudent()
    {
        return $this->hasRole(UserRoles::STUDENT);
    }

    public function isAuthor()
    {
        return $this->hasRole(UserRoles::AUTHOR);
    }

    public function canApprove()
    {
        return $this->isAdmin();
    }

    //todo author role check
    public function hasRole($role)
    {
        if ($role == "author") {
            return true;
        }
        return in_array($role, $this->getRoles());
    }

    public function setRole($role)
    {
        if ($this->hasRole($role)) {
            throw new \application\components\Exceptions\IntItaException(400, "User already has this role.");
        }
        $roleObj = Role::getInstance($role);
        return $roleObj->setRole($this->registrationData);
    }

    public function cancelRole(UserRoles $role)
    {
        if (!$this->hasRole($role)) {
            throw new \application\components\Exceptions\IntItaException(400, "User hasn't this role.");
        }
        $roleObj = Role::getInstance($role);
        return $roleObj->cancelRole($this->registrationData);
    }

    public function cancelRoleMessage(UserRoles $role)
    {
        if (!$this->hasRole($role)) {
            return "Користувачу не була призначена обрана роль.";
        }
        $roleObj = Role::getInstance($role);
        if ($roleObj->cancelRole($this->registrationData)) {
            return "Роль успішно відмінено.";
        } elseif ($roleObj->getErrorMessage() != "") {
            return $roleObj->getErrorMessage();
        } else {
            return "Роль не вдалося відмінити. Спробуйте пізніше або зверніться до адміністратора.";
        }
    }

    public function teacherRoles()
    {
        return array_intersect($this->getRoles(), TeacherRolesDataSource::roles());
    }

    public function noSetTeacherRoles()
    {
        return array_diff(TeacherRolesDataSource::roles(), array_intersect($this->getRoles(), TeacherRolesDataSource::roles()), array(UserRoles::AUTHOR));
    }

    public function requests()
    {
        if (!$this->isAdmin() && !$this->isContentManager())
            return [];
        else {
            return $this->loadRequests();
        }
    }

    private function loadRequests()
    {
        $authorRequests = MessagesAuthorRequest::notApprovedRequests();
        $consultantRequests = MessagesTeacherConsultantRequest::notApprovedRequests();

        $result = array_merge($authorRequests, $consultantRequests);
        if($this->isAdmin()){
            $assignCoworkerRequests = MessagesCoworkerRequest::notApprovedRequests();
            $result = array_merge($result, $assignCoworkerRequests);
        }

        return $result;
    }

    public function canPlanConsultation(Teacher $teacher)
    {
        return $this->registrationData->id != $teacher->user_id;
    }

    public function canSendRequest($module)
    {
        if (!$this->isTeacher())
            return false;
        else {
            $request = new MessagesAuthorRequest();
            return !$request->isRequestOpen(array($module, $this->registrationData->id));
        }
    }

    public function canAddResponse()
    {
        return $this->isStudent();
    }

    public function hasLectureAccess(Lecture $lecture, $editMode = false, $idCourse = 0){
        $enabledLessonOrder = Lecture::getLastEnabledLessonOrder($lecture->idModule);
        if ($this->isAdmin() || $editMode) {
            return true;
        }
        if ($this->isTeacherConsultant()) {
            $consult = new TeacherConsultant();
            if($consult->checkModule($this->registrationData->id, $lecture->idModule)){
                return true;
            }
        }
        if ($this->isConsultant()) {
            $consult = new Consultant();
            if(!$consult->checkModule($this->registrationData->id, $lecture->idModule)){
                return true;
            }
        }
        if($idCourse!=0){
            $course = Course::model()->findByPk($idCourse);
            if(!$course->status)
                throw new \application\components\Exceptions\IntItaException('403', Yii::t('lecture', '0811'));}
        if (!($lecture->isFree)) {
            $modulePermission = new PayModules();
            if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $lecture->idModule, array('read')))
                throw new CHttpException(403, Yii::t('errors', '0139'));
            if ($lecture->order > $enabledLessonOrder)
                throw new CHttpException(403, Yii::t('errors', '0646'));
        } else {
            if ($lecture->order > $enabledLessonOrder)
                throw new CHttpException(403, Yii::t('errors', '0646'));
        }

        return true;
    }

    public function hasLecturePagesAccess(Lecture $lecture, $editMode = false){
        if ($this->isAdmin() || $editMode) {
            return true;
        }
        if ($this->isTeacherConsultant()) {
            $consult = new TeacherConsultant();
            if($consult->checkModule($this->registrationData->id, $lecture->idModule)){
                return true;
            }
        }
        if ($this->isConsultant()) {
            $consult = new Consultant();
            if(!$consult->checkModule($this->registrationData->id, $lecture->idModule)){
                return true;
            }
        }

        return false;
    }
}
