<?php

class AuthorController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAuthor();
    }

    public function actionModules($id)
    {
        $consultant = RegisteredUser::userById($id);
        $modules = $consultant->getAttributesByRole(UserRoles::AUTHOR)["module"];

        $this->renderPartial('/_consultant/_modules', array(
            'attribute' => $modules,
            'user' => $consultant
        ), false, true);
    }
}