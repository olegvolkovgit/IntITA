<?php

class RoleAttributesController extends TeacherCabinetController
{
    public function hasRole()
    {

        return Yii::app()->user->model->isContentManager();
    }

    public function actionAuthorAttributes()
    {
        $this->renderPartial('authorAttributes', array(), false, true);
    }

    public function actionTeacherConsultantAttributes()
    {
        $this->renderPartial('teacherConsultantAttributes', array(), false, true);
    }

    public function actionEditRole($id, $role)
    {
        $user = RegisteredUser::userById($id);
        $role = new UserRoles($role);
        if(!in_array($role, AllRolesDataSource::teacherRoles())){
            throw new \application\components\Exceptions\IntItaException(403, "Редагувати роль не можна");
        }
        $attributes = $user->getAttributesByRole($role);

        $this->renderPartial('editRole', array(
            'model' => $user->registrationData,
            'role' => $role,
            'attributes' => $attributes
        ),false,true);
    }

    public function actionSetTeacherRoleAttribute($userId,$role,$attribute,$attributeValue)
    {
        if($role!=UserRoles::TRAINER) {
            $user = RegisteredUser::userById($userId);
            $result = array();
            if ($userId && $attribute && $attributeValue && $role) {
                $response = $user->setRoleAttribute(new UserRoles($role), $attribute, $attributeValue);
                if ($response === true) {
                    $result['data'] = "success";
                } else {
                    $result['data'] = $response;
                }
            } else {
                $result['data'] = 'Введені не вірні дані';
            }
            echo json_encode($result);
        }
    }
    public function actionUnsetTeacherRoleAttribute($userId,$role,$attribute,$attributeValue)
    {
        if($role!=UserRoles::TRAINER) {
            $user = RegisteredUser::userById($userId);
            $result = array();
            if ($userId && $attribute && $attributeValue && $role) {
                $response = $user->unsetRoleAttribute(new UserRoles($role), $attribute, $attributeValue);
                if ($response === true) {
                    $result['data'] = "success";
                } else {
                    $result['data'] = $response;
                }
            } else {
                $result['data'] = 'Введені не вірні дані';
            }
            echo json_encode($result);
        }
    }
}