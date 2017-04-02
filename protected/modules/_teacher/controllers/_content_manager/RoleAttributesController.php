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
}