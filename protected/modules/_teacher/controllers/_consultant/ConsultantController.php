<?php

class ConsultantController extends TeacherCabinetController
{
    public function actionModules($id)
    {
        $consultant = RegisteredUser::userById($id);
        $modules = $consultant->getAttributesByRole(UserRoles::CONSULTANT)[0];

        $this->renderPartial('/_consultant/_modules', array(
            'attribute' => $modules,
            'user' => $consultant
        ), false, true);
    }
}