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
    private $_teacher_roles;
    //Teacher model
    private $_teacher;
    private $_organizations;
    private $_isTeacher = false;
    private $_roleAttributes = array();

    public $lectureAccessErrorMessage;

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

    public function getRoles($organization=null)
    {
        $organization=$organization?$organization:Yii::app()->session['organization'];
        if ($this->_roles === null) {
            $this->_roles = $this->loadRoles($organization);
        }
        return $this->_roles;
    }

    public function getTeacherRoles($organization)
    {
        if ($this->_teacher_roles === null) {
            $this->_teacher_roles = $this->loadTeacherRoles($organization);
        }
        return $this->_teacher_roles;
    }

    private function loadRoles($organization=null)
    {
        $sql = '';
        $roles = AllRolesDataSource::roles();
        $lastKey = array_search(end($roles), $roles);
        foreach($roles as $key=>$role){
            $model = Role::getInstance($role);
            $sql .= "(".$model->checkRoleSql($organization).")";
            if ($key != $lastKey) {
                $sql .= " union ";
            }
        }

        $rolesArray = Yii::app()->db->createCommand($sql)->bindValue(":id",$this->id,PDO::PARAM_STR)->queryAll();

        $result = array_map(function ($row) {
            return new UserRoles($row["director"]);
        }, $rolesArray);

        return $result;
    }

    private function loadTeacherRoles($organization)
    {
        $sql = '';
        $roles = AllRolesDataSource::teacherRoles();
        $lastKey = array_search(end($roles), $roles);
        foreach($roles as $key=>$role){
            $model = Role::getInstance($role);
            $sql .= "(".$model->checkRoleSql($organization).")";
            if ($key != $lastKey) {
                $sql .= " union ";
            }
        }
        $rolesArray = Yii::app()->db->createCommand($sql)->bindValue(":id",$this->id,PDO::PARAM_STR)->queryAll();
        $result = array_map(function ($row) {
            return new UserRoles($row["accountant"]);
        }, $rolesArray);
        return $result;
    }

    public function loadRolesByOrganizations()
    {
        $sql = '';
        $roles = AllRolesDataSource::teacherRoles();
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
            return $row["accountant"];
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
        return Teacher::model()->findByAttributes(array('user_id' => $this->registrationData->id,'cancelled'=>Teacher::ACTIVE));
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

    public function getAttributesByRole($role, $organization=null)
    {
        if (empty($this->_roleAttributes[(string)$role])) {
            $this->loadAttributes($role, $organization);
        }
        return $this->_roleAttributes[(string)$role];
    }

    private function loadAttributes($role, $organization=null)
    {
        if ($this->hasRole($role,$organization)) {
            $roleObj = Role::getInstance($role);
            $this->_roleAttributes[(string)$role] = $roleObj->attributes($this->registrationData,$organization);
        }else{
            throw new \application\components\Exceptions\IntItaException(403, "User does not has this role.");
        }
        return $this->_roleAttributes[(string)$role];
    }

    public function setRoleAttribute($role, $attribute, $value)
    {
        if(!$this->hasRole($role)){
            throw new \application\components\Exceptions\IntItaException(403, 'Користувач не має даної ролі');
        };
        $roleObj = Role::getInstance($role);
        if($roleObj->setAttribute($this->registrationData, $attribute, $value))
            return true;
        else return $roleObj->getErrorMessage();
    }

    public function unsetRoleAttribute($role, $attribute, $value)
    {
        $roleObj = Role::getInstance($role);
        date_default_timezone_set(Config::getServerTimezone());
        if($roleObj->cancelAttribute($this->registrationData, $attribute, $value))
            return true;
        else return $roleObj->getErrorMessage();
    }

    public function isAdmin($organizationId=null)
    {
        return $this->hasRole(UserRoles::ADMIN,$organizationId);
    }

    public function isAccountant()
    {
        return $this->hasRole(UserRoles::ACCOUNTANT);
    }

    public function isTrainer()
    {
        return $this->hasRole(UserRoles::TRAINER);
    }

    public function isTeacherConsultant($organizationId=null)
    {
        return $this->hasRole(UserRoles::TEACHER_CONSULTANT, $organizationId);
    }

    public function isContentManager($organizationId=null)
    {
        return $this->hasRole(UserRoles::CONTENT_MANAGER,$organizationId);
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

    public function isAuthor($organizationId=null)
    {
        return $this->hasRole(UserRoles::AUTHOR,$organizationId);
    }

    public function isAuthorModule($moduleId)
    {
        $module=Module::model()->findByPk($moduleId);
        if($this->isAuthor($module->id_organization) && Yii::app()->db->createCommand('select idTeacher from teacher_module where idModule='.$moduleId.
            ' and idTeacher='.$this->id.' and end_time IS NULL')->queryScalar())
            return true;
        else return false;
    }

    public function isTeacherConsultantModule($moduleId)
    {
        $module=Module::model()->findByPk($moduleId);
        if ($this->isTeacherConsultant($module->id_organization) && !empty(Yii::app()->db->createCommand('select id_module from teacher_consultant_module where id_module=' . $moduleId .
            ' and id_teacher=' . $this->id . ' and end_date IS NULL')->queryAll()))
            return true;
        else return false;
    }

    public function isSuperVisor()
    {
        return $this->hasRole(UserRoles::SUPERVISOR);
    }

    public function isDirector()
    {
        return $this->hasRole(UserRoles::DIRECTOR);
    }

    public function isAuditor()
    {
        return $this->hasRole(UserRoles::AUDITOR);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole(UserRoles::SUPER_ADMIN);
    }

    public function canApprove($moduleId=null,$courseId=null, $organizationId=null)
    {
        if($moduleId) {
            $organizationId=Module::model()->findByPk($moduleId)->id_organization;
        }else if($courseId){
            $organizationId=Course::model()->findByPk($courseId)->id_organization;
        }

        return $this->isContentManager($organizationId);
    }

    public function hasAccessToContent(Module $module=null, Course $course=null)
    {
        $organization=$module?$module->id_organization:$course->id_organization;
        $roles=$this->loadRoles($organization);
        if(count(array_uintersect($roles, AllRolesDataSource::globalRoles(),"strcasecmp")))
            return true;
        if(count(array_uintersect($roles, AllRolesDataSource::localRoles(),"strcasecmp")))
            return true;

        return false;
    }

    public function hasRole($role, $organization=null)
    {
        return in_array($role, $this->getRoles($organization));
    }

    public function setRole($role, $organization=null)
    {
        if ($this->hasRole($role, $organization)) {
            throw new \application\components\Exceptions\IntItaException(400, "User already has this role.");
        }
        $roleObj = Role::getInstance($role);
        return $roleObj->setRole($this->registrationData, $organization);
    }

    public function cancelRole(UserRoles $role, $organization=null)
    {
        if (!$this->hasRole($role, $organization)) {
            throw new \application\components\Exceptions\IntItaException(400, "User hasn't this role.");
        }
        $roleObj = Role::getInstance($role);
        return $roleObj->cancelRole($this->registrationData, $organization);
    }

    public function cancelRoleMessage(UserRoles $role, $organization=null)
    {
        if (!$this->hasRole($role, $organization)) {
            return "Користувачу не була призначена обрана роль.";
        }
        $roleObj = Role::getInstance($role);
        if ($roleObj->cancelRole($this->registrationData, $organization)) {
            return true;
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

    public function noSetRoles()
    {
        return array_diff(AllRolesDataSource::roles(), array_intersect($this->getRoles(), AllRolesDataSource::roles()), array(UserRoles::AUTHOR));
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
        if($this->isContentManager()){
            $revisionRequests = MessagesRevisionRequest::notApprovedRequests();
            $moduleRevisionRequests = MessagesModuleRevisionRequest::notApprovedRequests();
            $result = array_merge($result, $revisionRequests, $moduleRevisionRequests);
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
    //id - id user one of which left a review
    public function canAddResponse($id)
    {
        return $this->isStudent() && $this->id!=$id;
    }

    public function hasLectureAccess(Lecture $lecture, $idCourse = 0){
        $enabledLessonOrder = $lecture->module->getLastAccessLectureOrder();

        if (!$this->hasAccessToContent($lecture->module)) {
            if(!$lecture->module->getModuleStatus($idCourse)){
                $this->lectureAccessErrorMessage=$lecture->module->errorMessage;
                return false;
            }

            if(!$lecture->module->checkPaidModuleAccess($this->id) && $idCourse && $lecture->module->checkPaidModuleCourseAccess($this->id, $idCourse)){
                $courseModules=CourseModules::model()->findByAttributes(array('id_course'=>$idCourse,'id_module'=>$lecture->module->module_ID));
                CourseModules::setModuleProgressInCourse($courseModules);
                $this->lectureAccessErrorMessage=$courseModules->statusMessage;
                if($this->lectureAccessErrorMessage) return false;
            }

            if(!$lecture->module->checkPaidModuleAccess($this->id) && !$idCourse && $lecture->module->checkPaidModuleCourseAccess($this->id, null)){
                $arrayMsg=array();
                foreach ($lecture->module->inCourses as $courseModules){
                    if(!$courseModules->check) {
                        CourseModules::setModuleProgressInCourse($courseModules);
                        if($courseModules->statusMessage)
                            array_push($arrayMsg,$courseModules->statusMessage);
                    }
                }

                if(!empty($arrayMsg)) {
                    $this->lectureAccessErrorMessage=ucfirst(strtolower(implode(" або ", $arrayMsg)));
                    return false;
                };
            }

            if($lecture->isFree && $lecture->order<=$enabledLessonOrder){
                return true;
            }else if($lecture->isFree && $lecture->order>$enabledLessonOrder) {
                $this->lectureAccessErrorMessage=Yii::t('exception', '0870');
                return false;
            }
            if(!$lecture->isFree && !$lecture->module->checkPaidAccess($this->id)){
                $this->lectureAccessErrorMessage=Yii::t('exception', '0869');
                return false;
            }else{
                if ($lecture->order>$enabledLessonOrder){
                    $this->lectureAccessErrorMessage=Yii::t('exception', '0870');
                    return false;
                }
            }
        }

        return true;
    }

    public function hasModuleAccess(Lecture $lecture, $idCourse = 0){
        if(!$lecture->module->checkPaidModuleAccess($this->id) && $idCourse && $lecture->module->checkPaidAccess($this->id)){
            $courseModules=CourseModules::model()->findByAttributes(array('id_course'=>$idCourse,'id_module'=>$lecture->module->module_ID));
            CourseModules::setModuleProgressInCourse($courseModules);
            $this->lectureAccessErrorMessage=$courseModules->statusMessage;
            return false;
        }

        return true;
    }

    public function hasLecturePagesAccess(Lecture $lecture){
        return $this->hasAccessToContent($lecture->module);
    }

    public function lastLink()
    {
        if($this->registrationData->lastLink)
            return $this->registrationData->lastLink->last_link;
        else return false;
    }

    public function canUpdateCourse($course)
    {
        return $this->isContentManager();
    }

    public function canUnlockUser()
    {
        return $this->isSuperAdmin();
    }

    public function canSetGlobalRole()
    {
        return $this->isDirector();
    }

    public function getOrganizations()
    {
        if ($this->_organizations === null) {
            $resultArray=array();
            $organizations=array();
            foreach (AllRolesDataSource::localRoles() as $role){
                $roleObj = Role::getInstance($role);
                $roleObj->getOrganizations();
                $resultArray= array_merge($resultArray, $roleObj->getOrganizations());
            }
            foreach ($resultArray as $organization){
                array_push($organizations,$organization['id_organization']);
            }
            $this->_organizations = array_unique($organizations);
        }
        return $this->_organizations;
    }

    public function getOrganizationsModel()
    {
        $organizations = $this->getOrganizations();

        $criteria = new CDbCriteria();
        $criteria->distinct = true;
        $criteria->addInCondition('id', $organizations);
        return Organization::model()->findAll($criteria);
    }

    /**
     * @param {integer} $id
     * @return bool
     */
    public function hasOrganizationById($id) {
        return in_array($id, $this->getOrganizations());
    }

    /**
     * @return Organization
     */
    public function getCurrentOrganization() {
        return Organization::model()->findByPk(Yii::app()->session->get('organization'));
    }

    /**
     * @return Organization
     */
    public function getCurrentOrganizationId() {
        $organization=Organization::model()->findByPk(Yii::app()->session->get('organization'));
        return $organization?$organization->id:null;
    }
    
    public function hasAccessToGlobalRoleLists($organization)
    {
        $organization=filter_var($organization, FILTER_VALIDATE_BOOLEAN);
        if(!$organization){
            if(!($this->isDirector() || $this->isSuperAdmin() || $this->isAuditor()))
                throw new \application\components\Exceptions\IntItaException(403, "Не має доступу");
        }
        return true;
    }

    public function hasAccessToOrganizationModel($model)
    {
        if(!$model || $model->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id){
            throw new \application\components\Exceptions\IntItaException(403, 'Ти не маєш доступу до дії в межах даної організації');
        }
        return true;
    }

    public function isTeacherOrganization()
    {
        return TeacherOrganization::model()->findByAttributes(array(
            'id_user' => $this->registrationData->id,
            'end_date'=>null,
            'id_organization'=>Yii::app()->user->model->getCurrentOrganizationId())
        );
    }

    public function canViewModuleRevision($idModule)
    {
        return Teacher::isTeacherAuthorModule($this->registrationData->id, $idModule) || $this->canApprove($idModule, null, null);
    }

    public function canViewCourseRevisions($idCourse)
    {
        return $this->canApprove(null, $idCourse, null);
    }

    /**
     * Check user for graduate
     * @return true if user is graduate
     */
    public function isGraduate()
    {
        if (Graduate::model()->findByAttributes(array('id_user'=>$this->registrationData->id))){
            return true;
        }

        return false;
    }

    public function isСoworker()
    {
       return $this->isTeacher() || $this->isDirector() || $this->isSuperAdmin() || $this->isAuditor() || $this->isAdmin();
    }

}
