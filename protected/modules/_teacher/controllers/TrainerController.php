<?php

class TrainerController extends TeacherCabinetController
{
    public function actionStudents($id)
    {
        $trainer = RegisteredUser::userById($id);
        $students = $trainer->getAttributesByRole(UserRoles::TRAINER)[0];

        $this->renderPartial('_students', array(
            'attribute' => $students,
            'user' => $trainer
        ), false, true);
    }
}