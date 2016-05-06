<?php

class AuthorController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAuthor();
    }

    public function actionModules($id)
    {
        $author = RegisteredUser::userById($id);
        $modules = $author->getAttributesByRole(UserRoles::AUTHOR)["module"];

        $this->renderPartial('/_author/_modules', array(
            'attribute' => $modules,
            'user' => $author
        ), false, true);
    }
}