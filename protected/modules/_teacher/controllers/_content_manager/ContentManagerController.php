<?php

class ContentManagerController extends TeacherCabinetController
{

    public function hasRole(){
        return Yii::app()->user->model->isContentManager();
    }

    public function actionAuthors()
    {
        $this->renderPartial('/_content_manager/authors');
    }

    public function actionConsultants()
    {
        $this->renderPartial('/_content_manager/consultants');
    }

    public function actionTeacherConsultants()
    {
        $this->renderPartial('/_content_manager/teacherConsultants', array(), false, true);
    }

    public function actionAddConsultantModuleForm(){
        $this->renderPartial('/_content_manager/_addConsultantModule', array(), false, true);
    }

    public function actionAddTeacherConsultantForm(){
        $this->renderPartial('/_content_manager/_addTeacherConsultant', array(), false, true);
    }

    public function actionAddTeacherModuleForm(){
        $this->renderPartial('/_content_manager/_addTeacherAccess', array(), false, true);
    }

    public function actionSetTeacherRoleAttribute()
    {
        $request = Yii::app()->request;
        $userId = $request->getPost('user', 0);
        $role = $request->getPost('role', '');
        $attribute = $request->getPost('attribute', '');
        $value = $request->getPost('attributeValue', 0);
        $user = RegisteredUser::userById($userId);

        if ($userId && $attribute && $value && $role) {
            if($user->setRoleAttribute(new UserRoles($role), $attribute, $value)){
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }

    public function actionCancelTeacherPermission()
    {
        $teacher = Yii::app()->request->getPost('user', '0');
        $module = Yii::app()->request->getPost('module', '0');

        $user = RegisteredUser::userById($teacher);
        if($user->unsetRoleAttribute(UserRoles::AUTHOR, 'module', $module)){
            $permission = new PayModules();
            $permission->unsetModulePermission($teacher, $module, array('read', 'edit'));
            echo "success";
        } else {
            echo "error";
        }
    }

    public function actionGetTeacherConsultantsList()
    {
        echo UserTeacherConsultant::teacherConsultantsListCM();
    }

    public function actionGetAuthorsList()
    {
        echo TeacherModule::authorsList();
    }

    public function actionGetConsultantsList()
    {
        echo UserConsultant::consultantsList();
    }

    public function actionDashboard(){
        $this->renderPartial('/content_manager/_dashboard', array(), false, true);
    }

    public function actionEditTeacherConsultant($id){
        $user = RegisteredUser::userById($id);
        if($user) {
            $this->renderPartial('/_content_manager/_teacherConsultant', array(
                'user' => $user
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }

    public function actionViewConsultant($id){
        $user = RegisteredUser::userById($id);
        if($user) {
            $this->renderPartial('/_content_manager/_viewConsultant', array(
                'user' => $user
            ), false, true);
        } else {
            throw new \application\components\Exceptions\IntItaException(400);
        }
    }
}