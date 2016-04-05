<?php

class TrainerController extends TeacherCabinetController
{
    public function actionStudents($id, $filter="")
    {
        $trainer = RegisteredUser::userById($id);
        $students = $trainer->getAttributesByRole(UserRoles::TRAINER)[0];

        $this->renderPartial('/_trainer/_students', array(
            'attribute' => $students,
            'user' => $trainer
        ), false, true);
    }

    public function actionEditTeacher($id, $idModule){
        $student = RegisteredUser::userById($id);
        $module = Module::model()->findByPk($idModule);

        $this->renderPartial('/_trainer/_editTeacher', array(
            'student' => $student->registrationData,
            'module' => $module,
        ), false, true);
    }

    public function actionViewStudent($id){
        $student = RegisteredUser::userById($id);

        $this->renderPartial('/_trainer/_viewStudent', array(
            'student' => $student,
        ), false, true);
    }

    public function actionTeachersByQuery($query){
        echo Teacher::teachersByQuery($query);
    }
}