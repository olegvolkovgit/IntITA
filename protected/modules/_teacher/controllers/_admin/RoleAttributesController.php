<?php

class RoleAttributesController extends TeacherCabinetController
{
    public function hasRole()
    {
        return Yii::app()->user->model->isAdmin();
    }

    public function actionAuthorAttributes()
    {
        $this->renderPartial('authorAttributes', array(), false, true);
    }

    public function actionTeacherConsultantAttributes()
    {
        $this->renderPartial('teacherConsultantAttributes', array(), false, true);
    }
}