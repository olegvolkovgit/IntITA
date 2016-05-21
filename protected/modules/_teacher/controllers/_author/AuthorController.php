<?php

class AuthorController extends TeacherCabinetController
{
    public function hasRole(){
        return Yii::app()->user->model->isAuthor();
    }

    public function actionModules($id)
    {
        $author = RegisteredUser::userById($id);
        $role = new Author();
        $modules = $role->activeModules($author->registrationData);

        $this->renderPartial('/_author/_modules', array(
            'modules' => $modules,
            'user' => $author
        ), false, true);
    }
}